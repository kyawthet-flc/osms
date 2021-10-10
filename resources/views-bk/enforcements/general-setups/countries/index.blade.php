@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Country']">
    
<a href="{{ route('general_setup.countries.create') }}" class="btn btn-primary float-left mb-3">Add Country</a>


    <table class="table table-bordered">
        <thead>
          <th style="width: 70px;">No.</th>
          <th>Name</th>
          <th>Name(in Myanmar)</th>
          <th>Code</th>
          <th>Action</th>
        </thead>
        <tbody>
          @foreach ($lists as $k => $list)
          <tr class="fee-display-wrapper">
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->name_mm }}</td>
            <td>{{ $list->code }}</td>
            <td>
              <a tr-id="{{ $k }}" class="fee-edit-button" href="{{ route('general_setup.countries.edit', $list) }}">Edit</a>
            </td>
          </tr>
          <tr style="display: none;background-color: #fafafa;" class="hide-tr-form-wrapper edit-form-{{  $k }}">
            <td colspan="5">
                <div class="col-md-8 offset-md-2">
                <form class="edit-form-wrapper" method="post" action="{{ route('general_setup.countries.update', $list) }}">
                @csrf
             
 
                <x-forms.text-input :attrs="['name' => 'name', 'required' => 'required', 
                  'value' => $list->name, 
                  'placeholder' => '', 
                  'label' => 'Name']" />

                  <x-forms.text-input :attrs="['name' => 'name_mm', 
                  'value' => $list->name_mm, 
                  'placeholder' => ' ', 
                  'label' => 'Name(in Myanmar)']" />
                
                  <x-forms.text-input :attrs="['name' => 'code', 'required' => 'required', 
                  'value' => $list->code, 
                  'placeholder' => '', 
                  'label' => 'Code']" />
                
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