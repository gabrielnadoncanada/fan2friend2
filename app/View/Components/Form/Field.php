<?php

namespace App\View\Components\Form;

use App\Traits\Themeable;
use Illuminate\View\Component;

class Field extends Component
{
    use Themeable;

    public function __construct($theme = 'default')
    {
        $this->theme = $theme;
    }

    public function render()
    {

        return $this->view('components.form.field');

    }
}
