<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AlertEmptyIcon extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $label;
    public $icon;

    public function __construct($label, $icon)
    {
        $this->label = $label;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.alert-empty-icon');
    }
}
