<?php

namespace App\View\Components;

use App\Traits\Themeable;
use Illuminate\View\Component;

class Badge extends Component
{
    use Themeable;

    public function __construct($theme = 'default')
    {
        $this->theme = $theme;
    }

    public function render()
    {
        return view('blade-components::components.badge');
    }
}
