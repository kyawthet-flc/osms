<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Textarea extends Component
{
    public $label;
    public $id;
    public $class;
    public $name;
    public $placeholder;
    public $required;
    public $value;
    public $readOnly;
    public $disabled;
  
    public function __construct($attrs = array())
    {
        $this->label = $attrs['label']?? '';
        $this->id = $attrs['id']?? '';
        $this->class = $attrs['class']?? '';
        $this->name = $attrs['name']?? '';
        $this->placeholder = !empty($attrs['placeholder'])?$attrs['placeholder'] : '';
        $this->required = !empty($attrs['required'])?$attrs['required'] : '';
        $this->value = !empty($attrs['value'])?$attrs['value'] : '';
        $this->readOnly = isset($attrs['readOnly']);
        $this->disabled = isset($attrs['disabled']);
    }

    public function render()
    {
        return view('components.forms.textarea');
    }
}
