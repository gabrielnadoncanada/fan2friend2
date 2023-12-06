<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CartComponent extends Component
{
    protected $total;

    protected $content;

    public function mount(): void
    {
        $this->updateCart();
    }

    public function removeFromCart(string $id): void
    {
        Cart::remove($id);
        $this->updateCart();
    }

    public function clearCart(): void
    {
        Cart::clear();
        $this->updateCart();
    }

    public function updateCartItem(string $id, string $action): void
    {
        Cart::update($id, $action);
        $this->updateCart();
    }

    public function updateCart()
    {
        $this->subtotal = Cart::subtotal();
        $this->taxes = Cart::taxes();
        $this->total = Cart::total();
        $this->content = Cart::content();
        $this->dispatch('cartUpdated');
    }

    public function render(): View
    {
        return view('livewire.cart', [
            'subtotal' => $this->subtotal,
            'taxes' => $this->taxes,
            'total' => $this->total,
            'content' => $this->content,
        ]);
    }
}
