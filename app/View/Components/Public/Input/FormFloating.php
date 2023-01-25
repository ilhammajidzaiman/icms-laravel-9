<?php

namespace App\View\Components\Tamu\Input;

use Illuminate\View\Component;

class FormFloating extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $type;
    public $id;
    public $name;
    public $value;
    public $label;
    public $class;

    public function __construct($type, $id, $name, $value, $label, $class)
    {
        $this->id = $id;
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
        return view('components.tamu.input.form-floating');
    }
}
