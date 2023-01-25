<?php

namespace App\View\Components\Private\Form;

use Illuminate\View\Component;

class InputSelect extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $label;
    public $class;

    public function __construct($name, $label, $class)
    {
        $this->name = $name;
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
        return view('components.private.form.input-select');
    }
}
