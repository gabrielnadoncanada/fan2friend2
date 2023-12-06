<?php

namespace App\Http\Livewire;

use App\Models\Celebrity;
use Livewire\Component;

class Header extends Component
{
    public $locale;

    public $search = '';

    public function mount()
    {
        $this->locale = session('locale') ?? config('app.locale');
    }

    public function switchLocale()
    {
        app()->setLocale($this->locale);
        session()->put('locale', $this->locale);
        $this->redirect(url()->previous());
    }

    public function render()
    {
        return view('livewire.header', [
            'celebrities' => Celebrity::search($this->search)->get(),
        ]);
    }
}
