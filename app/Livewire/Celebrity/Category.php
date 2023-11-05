<?php

namespace App\Livewire\Celebrity;

use App\Models\Celebrity;
use App\Models\Category as ModelsCategory;
use Livewire\Component;

class Category extends Component
{
    public $categories;
    public $selectedCategories = [];

    public function mount($category = null)
    {
        $this->categories = ModelsCategory::all();

        if ($category) {
            $this->selectedCategories[] = $category;
        }
    }

    public function render()
    {
        return view('livewire.celebrity.category', [
            'celebrities' => Celebrity::when(count($this->selectedCategories) > 0, function ($query) {
                $query->whereHas('categories', function ($subQuery) {
                    $subQuery->whereIn('slug', $this->selectedCategories);
                });
            })->get()
        ]);
    }

}
