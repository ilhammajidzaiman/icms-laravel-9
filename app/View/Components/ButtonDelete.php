<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonDelete extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $href;
    public $confirm;
    public $class;

    public function __construct($href, $confirm, $class)
    {
        $this->href = $href;
        $this->confirm = $confirm;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-delete');
    }
}
