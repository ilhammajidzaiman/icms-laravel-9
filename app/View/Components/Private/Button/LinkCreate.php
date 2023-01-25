<?php

namespace App\View\Components\Private\Button;

use Illuminate\View\Component;

class LinkCreate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $href;

    public function __construct($href)
    {
        $this->href = $href;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.private.button.link-create');
    }
}
