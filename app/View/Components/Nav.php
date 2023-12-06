<?php

namespace App\View\Components;

use App\Traits\Themeable;
use Illuminate\View\Component;

class Nav extends Component
{
    use Themeable;

    public function __construct($as = 'a', $theme = 'default')
    {
        $this->as = $as;
        $this->theme = $theme;
    }

    public function render()
    {
        return view('components.nav');
    }
}
