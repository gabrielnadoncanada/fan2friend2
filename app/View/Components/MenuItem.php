<?php

namespace App\View\Components;

use App\Traits\Themeable;
use Illuminate\View\Component;

class MenuItem extends Component
{
    use Themeable;

    public $as;

    public static $index;

    public function __construct($as = 'a', $theme = 'default')
    {
        $this->as = $as;
        $this->theme = $theme;
        self::$index++;
    }

    public function render()
    {
        return view('components.menu-item');
    }
}
