<!-- PAGENO: OSMS-017 -->
<x-forms.form-tag :attrs="['id' => 'customer-form', 'class' => 'customer-form', 'method' => $method, 'action' => $action ]">
    <input type="hidden" name="redirectUrl" value="{{ $redirectUrl?? url()->current() }}" />
    <input type="hidden" name="urlSegments" value="{{ isset($urlSegments)?json_encode($urlSegments): '' }}" />
    <x-forms.text-input :attrs="['name' => 'name', 'value' => $supplier->name, 'required' => 'required', 'label' => 'Name']" />
    <x-forms.text-input :attrs="['name' => 'email', 'value' => $supplier->email, 'label' => 'E-mail']" />
    <x-forms.text-input :attrs="['name' => 'phone', 'value' => $supplier->phone, 'label' => 'Phone', 'required' => 'required']" />
   <!--  coordinates -->
    <x-forms.select-with-object :attrs="['class' => 'ts_id escaped-select', 'name' => 'ts_id', 'selected' => $supplier->ts_id, 'label' => 'Township', 'list' => $townships]" />
    <x-forms.textarea :attrs="['name' => 'address', 'value' => $supplier->address, 'required' => 'required', 'label' => 'Address']" />
    <x-forms.textarea :attrs="['name' => 'desc', 'value' => $supplier->desc, 'label' => 'Description']" />
    <hr/>
    <x-forms.submit confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}' 
    :attrs="['name' => 'submit', 'class'=> 'common-sb-btn', 'value' => '', 'placeholder' => '', 'label' => $submitLabel]" />
</x-forms.form-tag>