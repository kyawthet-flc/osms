@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Fee']">
 
    <table class="table table-bordered">
        <thead>
          <!-- <th style="width: 70px;">No.</th> -->
          <th>Type</th>
          <th>Name</th>
          <th>code</th>
          <th>amount</th>
          <th>Action</th>
        </thead>
        <tbody>
          @foreach ($lists as $appMid => $listed)
          <tr style="background-color: #fafafa;">
            <td colspan="5"><b>{{ $applicationModules[$appMid] }}</b></td>
          </tr>
           @foreach($lists[$appMid] as $k => $list)
          <tr @if($list->status==='deleted') style="background-color: #d16666;color: #fafafa;" @endif class="fee-display-wrapper">
            <!-- <td>.</td> -->
            <td>{{ $list->type }}</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->code }}</td>
            <td>{{ $list->amount }} {{ $list->currency }}</td>
            <td>
              <a tr-id="{{ $appMid }}{{ $k }}" class="fee-edit-button" href="{{ route('general_setup.fees.edit', $list) }}">Edit</a>
            </td>
          </tr>
          <tr style="display: none;background-color: #fafafa;" class="hide-tr-form-wrapper edit-form-{{ $appMid }}{{ $k }}">
            <td colspan="5">
                <div class="col-md-8 offset-md-2">
                <form class="edit-form-wrapper" method="post" action="{{ route('general_setup.fees.update', $list) }}">
                @csrf
                <x-forms.select-with-key-value :attrs="[
                'name' => 'application_module_id', 
                'label' => 'Application Module', 
                'value' => $list->application_module_id, 
                'placeholder' => '', 
                'required' => 'required',
                'selected'=> $list->application_module_id,
                'list' => $applicationModules]" />

                <x-forms.select-with-value-value :attrs="[
                'name' => 'type', 
                'label' => 'Type', 
                'value' => $list->type, 
                'placeholder' => '', 
                'required' => 'required',
                'selected'=> $list->type,
                'list' => ['new', 'renew', 'amend', 'extension']]" />

                <x-forms.text-input :attrs="['name' => 'name', 'required' => 'required', 
                  'value' => $list->name, 
                  'placeholder' => '', 
                  'label' => 'Name']" />
                
                <x-forms.text-input :attrs="['name' => 'amount', 'required' => 'required', 
                  'value' => $list->amount, 
                  'placeholder' => '', 
                  'label' => 'Amount']" />

                  <x-forms.text-input :attrs="['name' => 'currency', 'required' => 'required', 
                  'value' => $list->currency, 
                  'placeholder' => '', 
                  'label' => 'Currency']" />
                
                  <x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
                @method('put')
                </form>
                </div>
            </td>
          </tr>
          @endforeach
          @endforeach
        </tbody>
      </table>

</x-utils.card>
@endsection

@section('js')
 @parent
 <script>

$('.fee-edit-button').click(function(e){ 

    e.preventDefault();   
        
    var editForm = $('.edit-form-' + $(this).attr('tr-id'));
    $('.fee-display-wrapper').css({ backgroundColor: '#fff' });

    if ( editForm.is(":visible") ) {
        editForm.hide();
    } else {
        $('.hide-tr-form-wrapper').hide();
        $(this).parents('tr.fee-display-wrapper').css({ backgroundColor: '#fafafa' });
        editForm.show();
    }
});
 </script>
@endsection