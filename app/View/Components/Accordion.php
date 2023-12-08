<?php

namespace App\View\Components;

use App\Traits\Themeable;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Accordion extends Component
{
    use Themeable;

    public $index;

    public $title;

    public function __construct($index = null, $title = false, $theme = 'default')
    {
        $this->index = $index;
        $this->title = $title;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View | Closure | string
    {
        return view('components.accordion');
    }
}
