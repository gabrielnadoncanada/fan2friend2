<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
	public $title;

	public $id;

	public $show;

	public function __construct($id, $show = false)
	{
		// $this->title = $title;
		$this->id = $id;
        $this->show = $show;
	}

	public function render()
	{
		return view('components.modal');
	}
}
