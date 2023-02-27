<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormFilePreview extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $label;
    public $accept;
    public $value;

    public function __construct($name, $label, $accept, $value)
    {
        $this->name = $name;
        $this->label = $label;
        $this->accept = $accept;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-file-preview');
    }
}
