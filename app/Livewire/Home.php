<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Celebrity;
use Livewire\Component;

class Home extends Component
{
    public $categories;
    public $featuredCelebrities;
    public $latestCelebrities;

    public function mount()
    {
        $this->categories = Category::all();
        $this->featuredCelebrities = Celebrity::where('featured', true)->take(5)->get();
        $this->latestCelebrities = Celebrity::orderBy('created_at', 'desc')->take(5)->get();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
