<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;

    public $id;

    public $show;

    public $isDismissible;

    public function __construct($id, $show = false, $isDismissible = true, $title = null)
    {
        $this->title = $title;
        $this->isDismissible = $isDismissible;
        $this->id = $id;
        $this->show = $show;
    }

    public function render()
    {
        return view('components.modal');
    }
}
