<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FileUpload extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $label;
    public $accept;
    public $class;

    public function __construct($name, $label, $accept, $class)
    {
        $this->name = $name;
        $this->label = $label;
        $this->accept = $accept;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.file-upload');
    }
}
