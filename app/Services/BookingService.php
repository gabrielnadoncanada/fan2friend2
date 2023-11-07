<?php

// App/Services/BookingService.php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\WaitingRoom;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Exception;

class BookingService
{
    /**
     * Book a service for a user.
     *
     * @param User $user
     * @param int $serviceId
     * @param array $bookingDetails
     * @return Order
     */
    public function bookService(User $user, int $serviceId, array $bookingDetails): Order
    {
        // Start a transaction to ensure data consistency
        return DB::transaction(function () use ($user, $serviceId, $bookingDetails) {
            // Check if the user is already in a waiting room
            if ($this->isUserAlreadyWaiting($user)) {
                throw new Exception("User is already in a waiting room.");
            }

            // Find the service being booked
            $service = Service::findOrFail($serviceId);

            // Create a new order
            $order = Order::create([
                'user_id' => $user->id,
                'status' => 'pending', // Or any other initial status
                // Add other order details from $bookingDetails if necessary
            ]);

            // Create an order item
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'service_id' => $service->id,
                'price' => $service->price,
                // Add other fields such as quantity, etc.
            ]);

            // Add user to the waiting room
            $this->addToWaitingRoom($user, $orderItem);

            return $order;
        });
    }

    /**
     * Add a user to a waiting room.
     *
     * @param User $user
     * @param OrderItem $orderItem
     * @return WaitingRoom
     */
    protected function addToWaitingRoom(User $user, OrderItem $orderItem): WaitingRoom
    {

        return WaitingRoom::create([
            'order_item_id' => $orderItem->id,
            'status' => 'waiting',
            'entered_at' => now(),
        ]);
    }

    /**
     * Check if the user is already in a waiting room.
     *
     * @param User $user
     * @return bool
     */
    protected function isUserAlreadyWaiting(User $user): bool
    {
        return WaitingRoom::whereHas('orderItem', function ($query) use ($user) {
            $query->where('user_id', $user->id)->whereIn('status', ['waiting', 'in_session']);
        })->exists();
    }
}
