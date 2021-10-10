
<div class="form-group" style="display: noane;">


<x-forms.text-input :attrs="[
    'name' => 'name', 
    'required' => 'required', 
    'value' => $onetimePurpose->name, 
    'placeholder' => '', 
    'label' => 'Name']" />

<x-forms.textarea :attrs="[
    'name' => 'description', 
    'value' => $onetimePurpose->description, 
    'placeholder' => ' ', 
    'label' => 'Description']" />

<x-forms.submit :attrs="['value' => '', 'placeholder' => '', 'label' => 'Save']" />


@section('js')
@parent
<script>

</script>
@endsection