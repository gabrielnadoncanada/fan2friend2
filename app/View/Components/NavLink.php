<?php

namespace App\View\Components;

use App\Traits\Themeable;
use Illuminate\View\Component;

class NavLink extends Component
{
    use Themeable;

    public $link;

    public $theme;

    public function __construct($link, $theme = 'default')
    {
        $this->link = $link;
        $this->theme = $this->isActive($link) ? 'active' : $theme;
    }

    public function isActive($link): bool
    {
        return request()->url() === $link;
    }

    public function render()
    {
        return view('components.nav-link');
    }
}
