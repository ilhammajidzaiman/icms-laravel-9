<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonDisable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $label;
    public $class;
    public $icon;
    public $confirm;

    public function __construct($label, $class, $icon, $confirm)
    {
        $this->label    = $label;
        $this->class    = $class;
        $this->icon     = $icon;
        $this->confirm  = $confirm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-disable');
    }
}
