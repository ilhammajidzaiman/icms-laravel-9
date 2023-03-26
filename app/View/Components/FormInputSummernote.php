<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInputSummernote extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $label;
    public $value;

    public function __construct($name, $label, $value)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-input-summernote');
    }
}
