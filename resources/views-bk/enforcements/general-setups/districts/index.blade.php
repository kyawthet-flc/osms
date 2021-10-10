@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'District']">
    
<a href="{{ route('general_setup.districts.create') }}" class="btn btn-primary float-left mb-3">Add District</a>


    <table class="table table-bordered">
        <thead>
          <th style="width: 70px;">No.</th>
          <th>State/ Division</th>
          <th>Name</th>
          <th>Name(in Myanmar)</th>
          <th>Action</th>
        </thead>
        <tbody>
          @php
            $lists->load(['division']);
            $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
          @endphp

          @foreach ($lists as $k => $list)
          <tr class="fee-display-wrapper">
            <td>{{ $indexer+$k+1 }}.</td>
            <td>{{ $list->division->name }}</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->name_mm }}</td>
            <td>
              <a tr-id="{{ $k }}" class="fee-edit-button" href="{{ route('general_setup.districts.edit', $list) }}">Edit</a>
            </td>
          </tr>
          <tr style="display: none;background-color: #fafafa;" class="hide-tr-form-wrapper edit-form-{{  $k }}">
            <td colspan="5">
                <div class="col-md-8 offset-md-2">
                <form class="edit-form-wrapper" method="post" action="{{ route('general_setup.districts.update', $list) }}">
                @csrf

                <x-forms.select-with-key-value :attrs="['name' => 'division_id', 'required' => 'required', 
                'value' => $list->division_id, 
                'placeholder' => '', 
                'selected' => $list->division_id,
                'list' => $divisions,
                'label' => 'Division']" />             
 
                <x-forms.text-input :attrs="['name' => 'name', 'required' => 'required', 
                  'value' => $list->name, 
                  'placeholder' => '', 
                  'label' => 'Name']" />

                  <x-forms.text-input :attrs="['name' => 'name_mm', 
                  'value' => $list->name_mm, 
                  'placeholder' => ' ', 
                  'label' => 'Name(in Myanmar)']" />
              
                  <x-forms.submit :attrs="['name' => 'submit', 'value' => '', 'placeholder' => '', 'label' => 'Save']" />
                @method('put')
                </form>
                </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

      <div class="row">
        <div class="col-md-12">
          {{ $lists->appends([])->links() }}
        </div>
      </div>

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