<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Celebrity;
use App\Models\Partner;
use Livewire\Component;

class Home extends Component
{
    public $categories;

    public $featuredCelebrities;

    public $latestCelebrities;

    public $partners;

    public function mount()
    {
        $this->categories = Category::all();
        $this->featuredCelebrities = Celebrity::whereHas('categories', function ($query) {
            $query->where('title', 'En vedette');
        })->take(5)->get();
        $this->latestCelebrities = Celebrity::orderBy('created_at', 'desc')->take(5)->get();
        $this->partners = Partner::all();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
