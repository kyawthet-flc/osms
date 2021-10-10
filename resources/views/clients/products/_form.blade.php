<!-- PAGENO: OSMS-010 -->
<x-forms.form-tag :attrs="['id' => 'shop-form', 'class' => 'shop-form', 'method' => $method, 'action' => $action ]">

    <x-forms.select-with-key-value :attrs="[
        'class' => 'shop_id escaped-select', 
        'name' => 'shop_id', 
        'selected' => $product->shop_id, 
        'label' => 'Shop',
        'list' => $shops, 
        'required' => 'required'
    ]" />
    <x-forms.select-with-key-value :attrs="[
        'class' => 'product_type_id escaped-select', 
        'name' => 'product_type_id', 
        'selected' => $product->product_type_id, 
        'label' => 'Product Category', 
        'list' => $productTypes,
        'required' => 'required'
    ]" />
    <x-forms.text-input :attrs="['name' => 'name', 'value' => $product->name, 'required' => 'required', 'label' => 'Product Name']" />
    <x-forms.textarea :attrs="['name' => 'desc', 'value' => $product->desc, 'label' => 'Description']" />
    <x-forms.radio-input :attrs="['name' => 'status', 'checked' => $product->status?? 'on_sale','label' =>
         'Shop Status', 'list' => $status]" />
    <hr/>
    <x-forms.submit confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}'
     :attrs="['name' => 'submit', 'class'=> 'common-sb-btn', 'value' => '', 'placeholder' => '', 'label' => $submitLabel]" />
</x-forms.form-tag>