<?php

namespace App\View\Components\Private;

use Illuminate\View\Component;

class Pagination extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $pages;
    public $side;

    public function __construct($pages, $side)
    {
        $this->pages = $pages;
        $this->side = $side;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.private.pagination');
    }
}
