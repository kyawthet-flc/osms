<?php

namespace App\View\Components\OfficerActions;

use Illuminate\View\Component;
use App\View\Components\OfficerActions\ActionTraits;

class PreviewCertificate extends Component
{
    use ActionTraits;

    public $previewUrl;
    public $displayPreviewUrl;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($attrs = array())
    {
        $this->_init($attrs);
        $this->displayPreviewUrl = $attrs['displayPreviewUrl']?? false;
        $this->previewUrl = $attrs['previewUrl']?? '#';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.officer-actions.preview-certificate');
    }
}
