<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FieldDateDelete extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $delete;
    public $class;

    public function __construct($delete, $class)
    {
        $this->delete = $delete;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.field-date-delete');
    }
}
