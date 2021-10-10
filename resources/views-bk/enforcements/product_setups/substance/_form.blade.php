<x-forms.text-input :attrs="['name' => 'name', 'value' => $product->name, 'placeholder' => '', 'label' => 'Name']" />

<x-forms.select-with-key-value :attrs="[
          'name' => 'req_ba_be_status',
          'label' => 'Req Status',
          'value' => $product->req_ba_be_status,
          'placeholder' => '',
          'selected'=> $product->req_ba_be_status,
          'list' => $req_status ]" />

<x-forms.select-with-key-value :attrs="[
          'name' => 'admitted_status',
          'label' => 'Admitted Status',
          'value' => $product->admitted_status,
          'placeholder' => '',
          'selected'=> $product->admitted_status,
          'list' => $admitted_status ]" />

<x-forms.text-input :attrs="['name' => 'cas_no', 'value' => $product->cas_no, 'placeholder' => '', 'label' => 'Cas No']" />

<x-forms.text-input :attrs="['name' => 'source_name', 'value' => $product->source_name, 'placeholder' => '', 'label' => 'Source Name']" />

<x-forms.text-input :attrs="['name' => 'reason', 'value' => $product->reason, 'placeholder' => '', 'label' => 'Reason']" />

<x-forms.select-with-key-value :attrs="[
          'name' => 'product_type_id',
          'label' => 'Product Type',
          'value' => $product->product_type_id,
          'placeholder' => '',
          'selected'=> $product->product_type_id,
          'list' => $product_type ]" />

<x-forms.text-input :attrs="['name' => 'preferred_term', 'value' => $product->preferred_term, 'placeholder' => '', 'label' => 'Preferred Term']" />

<x-forms.text-input :attrs="['name' => 'controlled_sus', 'value' => $product->controlled_sus, 'placeholder' => '', 'label' => 'Controlled Sus']" />

<x-forms.select-with-key-value :attrs="[
          'name' => 'status',
          'label' => 'Status',
          'value' => $product->status,
          'placeholder' => '',
          'selected'=> $product->status,
          'list' => [ 'active' => 'Active', 'inactive' => 'Inactive'] ]" />

<x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
