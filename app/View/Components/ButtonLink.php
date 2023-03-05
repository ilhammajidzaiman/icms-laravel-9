<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonLink extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $href;
    public $label;
    public $class;
    public $icon;

    public function __construct($href, $label, $class, $icon)
    {
        $this->href     = $href;
        $this->label    = $label;
        $this->class    = $class;
        $this->icon     = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-link');
    }
}
