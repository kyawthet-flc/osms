<?php

namespace App\View\Components\Utils;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $id;
    public $class;
    public $backUrl;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($attrs = array() )
    {
        $this->title = $attrs['title']?? '';
        $this->id = $attrs['id']?? '';
        $this->backUrl = $attrs['backUrl']?? '';
        $this->class = $attrs['class']?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.utils.card');
    }
}
