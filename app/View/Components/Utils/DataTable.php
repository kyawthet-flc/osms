<?php

namespace App\View\Components\Utils;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $ths;
    public $class;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ths = null, $class=null)
    {
        $this->ths = $ths;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.utils.data-table');
    }
}
