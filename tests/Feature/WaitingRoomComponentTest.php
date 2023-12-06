<?php

namespace Tests\Feature;

use App\Enums\RecurringFrequencyType;
use App\Enums\WaitingRoomStatus;
use App\Livewire\WaitingRoomComponent;
use App\Models\Availability;
use App\Models\Celebrity;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\RecurringPattern;
use App\Models\User;
use App\Models\WaitingRoom;
use Carbon\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class WaitingRoomComponentTest extends TestCase
{
    /** @test */
    public function authenticated_user_can_access_waiting_room()
    {
        $this->actingAs(User::factory()->create());
        $celebrity = Celebrity::factory()->create();
        $component = Livewire::test(WaitingRoomComponent::class, ['celebrity' => $celebrity]);
        $component->assertDontSee('Error');
    }

    /** @test */
    public function it_correctly_determines_within_event_state()
    {
        $user = User::factory()->create();
        $user->assignRole('customer');
        Address::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $celebrity = Celebrity::factory()->create();

        $availability = Availability::factory()->create([
            'start_time' => Carbon::now()->subHour(),
            'end_time' => Carbon::now()->addHour(),
            'is_recurring' => true,
            'is_full_day' => false,
            'start_date' => now(),
            'end_date' => null,
            'celebrity_id' => $celebrity->id,
        ]);

        RecurringPattern::factory()->create([
            'availability_id' => $availability->id,
            'recurring_type' => RecurringFrequencyType::RECURRING_TYPE_WEEKLY,
            'repeat_interval' => 1,
            'repeat_by_days' => ['MO', 'TU', 'WE', 'TH', 'FR'],
            'repeat_by_months' => null,
            'max_occurrences' => null,
        ]);
        $component = Livewire::test(WaitingRoomComponent::class, ['celebrity' => $celebrity])
            ->call('fetchCurrentEvent');
        $this->assertTrue($component->get('isWithinEvent'));
    }

    /** @test */
    public function it_correctly_calculates_user_position_in_waiting_room()
    {
        // Arrange: Create users and a celebrity
        $celebrity = Celebrity::factory()->create();
        $users = User::factory()->count(5)->create()->each(function ($user) {
            $user->assignRole('customer');
            Address::factory()->create(['user_id' => $user->id]);
        }); // Create 5 users

        $availability = Availability::factory()->create([
            'start_time' => Carbon::now()->subHour(),
            'end_time' => Carbon::now()->addHour(),
            'is_recurring' => true,
            'is_full_day' => false,
            'start_date' => now(),
            'end_date' => null,
            'celebrity_id' => $celebrity->id,
        ]);

        $orderItems = $users->map(function ($user) use ($celebrity, $availability) {
            $order = Order::factory()->create(['customer_id' => $user->customer->id]);

            return OrderItem::factory()->create([
                'order_id' => $order->id,
                'duration' => $celebrity->duration,
                'price' => $celebrity->price,
                'availability_id' => $availability->id,
                'celebrity_id' => $celebrity->id,
                'scheduled_date' => now(),
                'start_time' => Carbon::now()->subHour(),
                'end_time' => Carbon::now()->addHour(),
            ]);
        });

        // Create WaitingRoom entries for each user
        $orderItems->each(function ($orderItem, $index) {
            WaitingRoom::create([
                'order_item_id' => $orderItem->id,
                'celebrity_id' => $orderItem->celebrity_id,
                'availability_id' => $orderItem->availability_id,
                'scheduled_date' => $orderItem->scheduled_date,
                'status' => WaitingRoomStatus::WAITING, // Adjust field names based on your schema
                'entered_at' => now()->addMinutes($index), // Simulating different entry times
            ]);
        });

        // Simulate the current user being the last one in the waiting room
        $currentUser = $users->last();
        $currentOrderItem = $orderItems->last();
        $this->actingAs($currentUser);
        // Act: Access the Livewire component as the last user
        $component = Livewire::test(WaitingRoomComponent::class, ['celebrity' => $celebrity])
            ->set('waitingRoomEntry', WaitingRoom::where('order_item_id', $currentOrderItem->id)->first())
            ->call('initWaitingRoom');

        // Assert: Check if the current user's position is last
        $this->assertEquals(5, $component->get('currentPosition')); // Position should be 5 (last in line)
    }
}
