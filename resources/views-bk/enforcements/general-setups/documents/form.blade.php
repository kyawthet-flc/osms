@extends('layouts.app')
@section('content')
 
<div class="row mt-5">

<div class="col-md-10 offset-md-1 mb-3">
  <a href="{{ route('general_setup.documents.index') }}" class="btn btn-primary float-left">Back</a>
</div>

<div class="col-md-10 offset-md-1">
  <x-utils.card :attrs="['title' => 'Creating Application Document']">
    <x-forms.form-tag :attrs="['id' => 'admin-user-form', 'class' => 'admin-user-form', 'method' => $methodName, 'action' => $routeUrl ]">
            <x-forms.select-with-key-value :attrs="[
                'name' => 'application_module_id', 
                'label' => 'Application Module', 
                'value' => $document->application_module_id, 
                'placeholder' => '', 
                'required' => 'required',
                'selected'=> $document->application_module_id,
                'list' => $applicationModules]" />

            <x-forms.text-input :attrs="['name' => 'sub_type', 'required' => 'required', 'value' => $document->sub_type, 'placeholder' => '', 'label' => 'Sub App Type']" />


            <x-forms.text-input :attrs="['name' => 'group_name', 'required' => 'required', 'value' => $document->group_name, 'require' => false, 'placeholder' => '', 'label' => 'Group Name']" />

            <x-forms.text-input :attrs="['name' => 'addition_filter', 'required' => 'required', 'value' => $document->addition_filter, 'require' => false, 'placeholder' => '', 'label' => 'Addition Filter']" />

            <x-forms.text-input :attrs="['name' => 'file_name', 'required' => 'required', 'value' => $document->file_name, 'placeholder' => '', 'label' => 'File Name']" />

            <div class="form-group">
                <label class="label-index">Require</label>
                <label><input type="radio" name="require"value="yes" checked="checked" /> Yes </label>
                <label><input type="radio" name="require" value="no" @if($document->require ==='no') checked="checked" @endif /> No</label>
                @if($errors->has('require'))
                    <label class="error mt-2 text-danger">{{ $errors->first('require') }}</label>
                @endif
            </div>

            <div class="form-group">
                <label class="label-index">Require If <input type="checkbox" name="toggleRequireIf" value="on" /></label>
                <input type="text" name="require_if" style="display: none;" class="form-control" value="" placeholder="Sample1, Sample2" />
            </div>           
            
            <x-forms.select-with-key-value :attrs="[
                'name' => 'min_size', 
                'label' => 'Min Size(MB)',
                'placeholder' => '', 
                'selected'=> $document->min_size?? 1,
                'list' => $fileSizes]" />

            <x-forms.select-with-key-value :attrs="[
                'name' => 'max_size', 
                'label' => 'Max Size(MB)',
                'placeholder' => '', 
                'selected'=> $document->max_size?? 5,
                'list' => $fileSizes]" />

            <x-forms.select-with-value-value :attrs="[
                'name' => 'file_type', 
                'label' => 'Video, PDF or Image',
                'placeholder' => '', 
                'selected'=> $document->file_type?? '',
                'list' => ['Video', 'PDF', 'Image']]" />

            <!-- <x-forms.text-input :attrs="['name' => 'mimes', 'value' => $document->mimes?? 'PDF', 'placeholder' => '', 'label' => 'MIME Type']" /> -->
            <div class="form-group mt-2">
                <label class="label-index">Mime Types</label>          
                <label>
                   <input type="radio" name="mimes" checked="checked"  value="pdf" @if($document->mimes ==='mimes:pdf') checked="checked" @endif /> mimes:pdf
                </label><br/>
                <label>
                  <input type="radio" name="mimes"  value="video" @if($document->mimes ==='mimetypes:video/*,video/x-m4v,video/mp4,video/x-m4v,video/x-matroska') checked="checked" @endif />
                  mimetypes:video/*,video/x-m4v,video/mp4,video/x-m4v,video/x-matroska
                </label><br/>
                <label>
                   <input type="radio" name="mimes"  value="image"@if($document->mimes ==='mimes:jpeg,png,jpg') checked="checked" @endif /> mimes:jpeg,png,jpg
                </label><br/>
                <label>
            </div>
      
            <x-forms.text-input :attrs="['name' => 'uploadable_file_count', 'value' => 1, 'placeholder' => '', 'label' => 'Uploadable File Count']" />

            <div class="form-group">
                <label class="label-index">Status</label>          
                <label><input type="radio" name="status"  value="active" checked="checked" />Active</label>
                <label><input type="radio" name="status"  value="deleted"  @if($document->status ==='deleted') checked="checked" @endif> Inactive </label>
            </div>           
          <x-forms.submit :attrs="['value' => '', 'placeholder' => '', 'label' => 'Save']" />
     </x-forms.form-tag>
   </x-utils.card>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  
  $(function(){
    
    var requireIf = "{{ old('require_if', $document->require_if) }}";

    if (requireIf) {
       $('input[name="toggleRequireIf"]').prop('checked', true);    
          $('input[name="require_if"]').show();  
    }

    $('input[name="toggleRequireIf"]').change(function(e){
       if ( $(this).is(':checked') ) {
          $('input[name="require_if"]').show();
       } else {
          $('input[name="require_if"]').val('').hide();
       }
    });

    $('body').on('change keyup', 'input[name="uploadable_file_count"]', function(e){
        if (/\D/g.test($(this).val())) {
          this.value = $(this).val().replace(/\D/g, '');
        }
    });

  });

</script>
@endsection

@section('css')
<style type="text/css">

    .department-form-wrapper {
        min-height: 700px;
        height: auto;
        padding: 30px 8px;
        background-color: #fff;
    }

    .uneditabl-department-code {
      font-size: 14px;
      color: red;
      font-weight: bolder;
    }

    .label-index {
        display: block;
        font-size: 17px;
    }

      .submit-form-wrapper {
        height: auto;
        padding: 35px 10px 10px;
        text-align: center;
    }
</style>
@endsection