<?php

namespace App\View\Components\OfficerActions;

use Illuminate\View\Component;

class PreviewRejection extends Component
{
    use ActionTraits;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($attrs = array())
    {
        $this->_init($attrs);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.officer-actions.preview-rejection');
    }
}