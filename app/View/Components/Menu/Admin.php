<?php

namespace App\View\Components\Menu;

use Illuminate\View\Component;

class Admin extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu.admin');
    }
}
