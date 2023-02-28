<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchInput extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $name;
    public $id;
    public $value;
    public $class;

    public function __construct($name, $id, $value, $class)
    {
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-input');
    }
}
