<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInputCheckbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $id;
    public $value;

    public function __construct($name, $id, $value)
    {
        $this->name         = $name;
        $this->id           = $id;
        $this->value        = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-input-checkbox');
    }
}
