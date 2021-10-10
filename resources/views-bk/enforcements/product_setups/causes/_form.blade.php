<x-forms.text-input :attrs="['name' => 'code', 'value' => $product->code, 'placeholder' => '', 'label' => 'Code']" />

          <!--  	Code 	Description 	Observance 	Product Type -->

<x-forms.text-input :attrs="['name' => 'desc', 'value' => $product->description, 'placeholder' => '', 'label' => 'Description']" />

<x-forms.text-input :attrs="['name' => 'observance', 'value' => $product->observance, 'placeholder' => '', 'label' => 'Observance']" />

<x-forms.select-with-key-value :attrs="[
          'name' => 'product_type_id',
          'label' => 'Product Type',
          'value' => $product->product_type_id,
          'placeholder' => '',
          'selected'=> $product->product_type_id,
          'list' => $product_type_ids], " />

<x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
