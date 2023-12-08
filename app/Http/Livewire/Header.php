<?php

namespace App\Http\Livewire;

use App\Facades\Cart;
use App\Models\Celebrity;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public $locale;

    public $search = '';

    public $cartCount;

    public function mount()
    {
        $this->updateCartCount();
        $this->locale = session('locale') ?? config('app.locale');
    }

    public function switchLocale()
    {
        app()->setLocale($this->locale);
        session()->put('locale', $this->locale);
        $this->redirect(url()->previous());
    }

    #[On('cartUpdated')]
    public function updateCartCount()
    {
        $this->cartCount = Cart::content()->count();
    }

    public function render()
    {
        return view('livewire.header', [
            'celebrities' => Celebrity::search($this->search)->get(),
        ]);
    }
}
