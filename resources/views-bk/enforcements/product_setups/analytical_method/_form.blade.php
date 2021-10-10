<x-forms.text-input :attrs="['name' => 'name', 'value' => $product->name, 'placeholder' => '', 'label' => 'Name']" />

<x-forms.text-input :attrs="['name' => 'desc', 'value' => $product->description, 'placeholder' => '', 'label' => 'Description']" />

<x-forms.text-input :attrs="['name' => 'observance', 'value' => $product->observance, 'placeholder' => '', 'label' => 'Observance']" />

 

<x-forms.text-input :attrs="['name' => 'ref_analysis_id', 'value' => $product->ref_analysis_id, 'placeholder' => '', 'label' => 'Reference Analysis']" />


<x-forms.select-with-key-value :attrs="[
          'name' => 'product_type_id',
          'label' => 'Product Type',
          'value' => $product->product_type_id,
          'placeholder' => '',
          'selected'=> $product->product_type_id,
          'list' => $product_type_ids ]" />

<x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
