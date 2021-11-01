<!-- PAGENO: OSMS-005 -->
<x-forms.form-tag :attrs="['id' => 'shop-form', 'class' => 'shop-form', 'method' => $method, 'action' => $action ]">
    <x-forms.text-input :attrs="['name' => 'name', 'value' => $shop->name, 'required' => 'required', 'label' => 'Shop Name']" />
    <x-forms.text-input :attrs="['name' => 'name_mm', 'value' => $shop->name_mm, 'label' => 'Shop Name MM']" />
    <x-forms.text-input :attrs="['name' => 'phone', 'value' => $shop->phone, 'label' => 'Phone']" />
    <x-forms.text-input :attrs="['name' => 'website', 'value' => $shop->website, 'label' => 'Shop Website URL']" />
    <x-forms.text-input :attrs="['name' => 'facebook', 'value' => $shop->facebook, 'label' => 'Shop Facebook Page URL']" />

    <x-forms.file-input :attrs="['name' => 'logo', 'value' => '', 'label' => 'Shop Logo']" />
    @if( $shop->logo )
    @php
      $file = App\Model\File::find($shop->logo);
      $encrptedImg = base64_encode($file->decryptFile())
    @endphp
    <img class="magnific-popup-img mt-1 mb-3" 
        style="width: 90px;height: 80px;" 
        src="data:image/{!! strtolower($file->file_extension)!!};base64,{!! $encrptedImg !!}" 
        href="data:image/{!! strtolower($file->file_extension)!!};base64,{!! $encrptedImg !!}" alt="Logo" />
    @endif
    <x-forms.select-with-object :attrs="['class' => 'ts_id escaped-select', 'name' => 'ts_id', 'selected' => $shop->ts_id, 'label' => 'Township', 'list' => $townships, 'required' => 'required']" />
    <x-forms.radio-input :attrs="['name' => 'status', 'checked' => $shop->status,'label' => 'Shop Status', 'list' => $status]" />
    <x-forms.textarea :attrs="['name' => 'address', 'value' => $shop->address, 'label' => 'Address']" />
    <x-forms.textarea :attrs="['name' => 'desc', 'value' => $shop->desc, 'label' => 'Description']" />
    <hr/>
    <x-forms.submit confirmationText='{{ $confirmationText?? "Are you sure to submit?" }}' 
    :attrs="['name' => 'submit', 'class'=> 'common-sb-btn', 'value' => '', 'placeholder' => '', 'label' => $submitLabel]" />

</x-forms.form-tag>