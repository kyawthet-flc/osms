<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class RadioInput extends Component
{
    public $label;
    public $id;
    public $class;
    public $name;
    public $list;
    public $checked;
  
    public function __construct($attrs = array())
    {
        $this->label = $attrs['label']?? '';
        $this->id = $attrs['id']?? '';
        $this->class = $attrs['class']?? '';
        $this->name = $attrs['name']?? '';
        $this->list = $attrs['list']?? [];
        $this->checked = $attrs['checked']?? false;
        $this->required = !empty($attrs['required'])?$attrs['required'] : '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.forms.radio-input');
    }
}
