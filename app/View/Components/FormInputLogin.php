<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInputLogin extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $type;
    public $name;
    public $label;
    public $value;
    public $class;

    public function __construct($type, $name, $label, $class, $value)
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->class = $class;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-input-login');
    }
}
