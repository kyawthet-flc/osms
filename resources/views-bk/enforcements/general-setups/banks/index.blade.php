@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Bank']">
 
    <table class="table table-bordered">
        <thead>
          <th style="width: 70px;">No.</th>
          <th>Name</th>
          <th>Description</th>
        </thead>
        <tbody>
          @foreach ($lists as $k => $list)
          <tr  class="bank-display-wrapper">
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->description }}</td>
            <td>
              <a tr-id="{{ $k }}" class="fee-edit-button" href="{{ route('general_setup.banks.edit', $list) }}">Edit</a>
            </td>
          </tr>
          <tr style="display: none;background-color: #fafafa;" class="hide-tr-form-wrapper edit-form-{{  $k }}">
            <td colspan="4">
                <div class="col-md-8 offset-md-2">
                <form class="edit-form-wrapper" method="post" action="{{ route('general_setup.banks.update', $list) }}">
                @csrf
              
                <x-forms.text-input :attrs="['name' => 'name', 'required' => 'required', 
                  'value' => $list->name, 
                  'placeholder' => '', 
                  'label' => 'Bank']" />

                <x-forms.textarea :attrs="['name' => 'description', 'required' => 'required', 
                  'value' => $list->description, 
                  'placeholder' => '', 
                  'label' => 'description']" />
                
                  <x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
                @method('put')
                </form>
                </div>
            </td>
          </tr>
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
    $('.bank-display-wrapper').css({ backgroundColor: '#fff' });

    if ( editForm.is(":visible") ) {
        editForm.hide();
    } else {
        $('.hide-tr-form-wrapper').hide();
        $(this).parents('tr.bank-display-wrapper').css({ backgroundColor: '#fafafa' });
        editForm.show();
    }
});
 </script>
@endsection