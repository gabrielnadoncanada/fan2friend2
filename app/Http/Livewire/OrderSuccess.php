<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderSuccess extends Component
{
    public Order $order;

    public function render()
    {

        return view('livewire.order-success');
    }
}
