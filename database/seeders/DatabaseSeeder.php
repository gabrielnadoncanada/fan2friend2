<?php

namespace Database\Seeders;

use App\Filament\Resources\OrderResource;
use App\Models\Category;
use App\Models\Address;

use App\Models\Celebrity;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Partner;
use App\Models\Payment;
use App\Models\User;
use Closure;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Helper\ProgressBar;

class DatabaseSeeder extends Seeder
{
    const IMAGE_URL = 'https://demofilament.test/placeholder.png';

    public function run(): void
    {
        Storage::deleteDirectory('public');
        // Admin
        $this->command->warn(PHP_EOL . 'Creating admin user...');
        $user = $this->withProgressBar(1, fn() => User::factory(1)->create([
            'name' => 'Demo User',
            'email' => 'admin@filamentphp.com',
        ]));
        $this->command->info('Admin user created.');

        // Shop
        $this->command->warn(PHP_EOL . 'Creating partners...');
        $this->withProgressBar(20, fn() => Partner::factory()->count(20)->create());
        $this->command->info('Partners created.');

        $this->command->warn(PHP_EOL . 'Creating categories...');
        $categories = $this->withProgressBar(5, fn() => Category::factory(1)->create());
        $this->command->info('Categories created.');

        $this->command->warn(PHP_EOL . 'Creating customers...');
        $customers = $this->withProgressBar(100, fn() => Customer::factory(1)
            ->has(Address::factory()->count(rand(1, 3)))
            ->create());
        $this->command->info('Customers created.');

        $this->command->warn(PHP_EOL . 'Creating celebrities...');
        $celebrities = $this->withProgressBar(50, fn() => Celebrity::factory(1)
            ->hasAttached($categories->random(1), ['created_at' => now(), 'updated_at' => now()])
            ->has(
                Comment::factory()->count(rand(10, 20))
                    ->state(fn(array $attributes, Celebrity $celebrity) => ['customer_id' => $customers->random(1)->first()->id]),
            )
            ->create());
        $this->command->info('Celebrities created.');

        $this->command->warn(PHP_EOL . 'Creating orders...');
        $orders = $this->withProgressBar(100, fn() => Order::factory(1)
            ->sequence(fn($sequence) => ['customer_id' => $customers->random(1)->first()->id])
            ->has(Payment::factory()->count(rand(1, 3)))
            ->has(
                OrderItem::factory()->count(rand(2, 5))
                    ->state(fn(array $attributes, Order $order) => ['celebrity_id' => $celebrities->random(1)->first()->id]),
                'items'
            )
            ->create());

        foreach ($orders->random(rand(5, 8)) as $order) {
            Notification::make()
                ->title('New order')
                ->icon('heroicon-o-shopping-bag')
                ->body("{$order->customer->name} ordered {$order->items->count()} celebrities.")
                ->actions([
                    Action::make('View')
                        ->url(OrderResource::getUrl('edit', ['record' => $order])),
                ])
                ->sendToDatabase($user);
        }
        $this->command->info('Orders created.');
    }

    protected function withProgressBar(int $amount, Closure $createCollectionOfOne): Collection
    {
        $progressBar = new ProgressBar($this->command->getOutput(), $amount);

        $progressBar->start();

        $items = new Collection();

        foreach (range(1, $amount) as $i) {
            $items = $items->merge(
                $createCollectionOfOne()
            );
            $progressBar->advance();
        }

        $progressBar->finish();

        $this->command->getOutput()->writeln('');

        return $items;
    }
}
