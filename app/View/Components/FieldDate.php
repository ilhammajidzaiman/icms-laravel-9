<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FieldDate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $create;
    public $update;
    public $class;

    public function __construct($create, $update, $class)
    {
        $this->create = $create;
        $this->update = $update;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.field-date');
    }
}
