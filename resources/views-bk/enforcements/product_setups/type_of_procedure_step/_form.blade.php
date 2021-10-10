<x-forms.text-input :attrs="['name' => 'code', 'value' => $product->code, 'placeholder' => '', 'label' => 'Code']" />

<x-forms.text-input :attrs="['name' => 'name', 'value' => $product->name, 'placeholder' => '', 'label' => 'Name']" />

<x-forms.text-input :attrs="['name' => 'processing_time', 'value' => $product->processing_time, 'placeholder' => '', 'label' => 'Processing Time']" />

<x-forms.text-input :attrs="['name' => 'desc', 'value' => $product->description, 'placeholder' => '', 'label' => 'Description']" />

<x-forms.select-with-key-value :attrs="[
          'name' => 'proc_type_id',
          'label' => 'Procedute Type',
          'value' => $product->proc_type_id,
          'placeholder' => '',
          'selected'=> $product->proc_type_id,
          'list' => $proc_type], " />

<x-forms.select-with-key-value :attrs="[
          'name' => 'product_type_id',
          'label' => 'Product Type',
          'value' => $product->product_type_id,
          'placeholder' => '',
          'selected'=> $product->product_type_id,
          'list' => $product_type], " />

<x-forms.select-with-key-value :attrs="[
          'name' => 'email_status',
          'label' => 'Email Status',
          'value' => $product->email_status,
          'placeholder' => '',
          'selected'=> $product->email_status,
          'list' => ['active' => 'Active', 'inactive' => 'Inactive']], " />

<x-forms.select-with-key-value :attrs="[
          'name' => 'status',
          'label' => 'Status',
          'value' => $product->status,
          'placeholder' => '',
          'selected'=> $product->status,
          'list' => ['active' => 'Active' , 'inactive' => 'Inactive']], " />

<x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
