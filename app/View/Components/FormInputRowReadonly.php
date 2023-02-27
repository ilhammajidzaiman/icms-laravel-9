<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInputRowReadonly extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $type;
    public $name;
    public $value;
    public $label;
    public $class;

    public function __construct($type, $name, $value, $label, $class)
    {
        $this->type = $type;
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
        return view('components.form-input-row-readonly');
    }
}
