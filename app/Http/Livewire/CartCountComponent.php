<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Livewire\Component;

class CartCountComponent extends Component
{
    public $cartCount;

    protected $listeners = ['cartUpdated' => 'updateCartCount'];

    public function mount()
    {
        $this->updateCartCount();
    }

    public function updateCartCount()
    {
        $this->cartCount = Cart::content()->count();
    }

    public function render()
    {
        return view('livewire.cart-count');
    }
}
