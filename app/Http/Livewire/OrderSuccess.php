<?php

namespace App\Http\Livewire;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Stripe\Stripe;

class OrderSuccess extends Component
{
    public Order $order;

    public function render()
    {

        return view('livewire.order-success');
    }
}
