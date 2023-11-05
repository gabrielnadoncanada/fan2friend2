<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{
    public array $links = [
        'exercises.index',
        'results',
        'help-page',
        'about',
        'users.index',
    ];

    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navigation');
    }
}
