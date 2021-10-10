<x-forms.text-input :attrs="['name' => 'code', 'value' => $product->code, 'placeholder' => '', 'label' => 'Code']" />

<x-forms.select-with-key-value :attrs="[
          'name' => 'level',
          'label' => 'Level',
          'value' => $product->level,
          'placeholder' => '',
          'selected'=> $product->level,
          'list' => $level ]" />

<x-forms.text-input :attrs="['name' => 'desc', 'value' => $product->description, 'placeholder' => '', 'label' => 'Description']" />

<x-forms.text-input :attrs="['name' => 'observance', 'value' => $product->observance, 'placeholder' => '', 'label' => 'Observance']" />

<x-forms.text-input :attrs="['name' => 'parent', 'value' => $product->parent, 'placeholder' => '', 'label' => 'Parent']" />

<x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
