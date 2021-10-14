<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title = '';
    public string $id = '';

    /**
     * Create a new component instance.
     *
     * @param $title
     * @param $id
     */
    public function __construct($title, $id)
    {
        $this->title = $title;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
