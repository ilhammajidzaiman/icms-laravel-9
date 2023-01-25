<?php

namespace App\View\Components\Tamu\Input;

use Illuminate\View\Component;

class FormTextarea extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $id;
    public $name;
    public $value;
    public $label;
    public $class;

    public function __construct($id, $name, $value, $label, $class)
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tamu.input.form-textarea');
    }
}
