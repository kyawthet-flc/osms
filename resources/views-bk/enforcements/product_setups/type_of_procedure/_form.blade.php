{{--<x-forms.text-input :attrs="['name' => 'code', 'value' => $product->code, 'placeholder' => '', 'label' => 'Code']" />--}}

<x-forms.text-input :attrs="['name' => 'name', 'value' => $product->name, 'placeholder' => '', 'label' => 'Name']" />

<x-forms.text-input :attrs="['name' => 'desc', 'value' => $product->description, 'placeholder' => '', 'label' => 'Description']" />

{{--<x-forms.text-input :attrs="['name' => 'observance', 'value' => $product->observance, 'placeholder' => '', 'label' => 'Observance']" />--}}

<x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
