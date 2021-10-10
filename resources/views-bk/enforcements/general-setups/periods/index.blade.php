@extends('layouts.app')
@section('content')
<x-utils.card :attrs="['title' => 'Country']">
    
<a href="{{ route('general_setup.periods.create') }}" class="btn btn-primary float-left mb-3">Add Period</a>


    <table class="table table-bordered">
        <thead>
          <th style="width: 70px;">No.</th>
          <th style="width: 210px;">Application Module</th>
          <th style="width: 170px;">Sub App Type</th>
          <th style="width: 250px;">Name</th>
          <th style="width: 100px;">Period</th>
          <th style="width: 120px;">Period Unit</th>
          <th>Remark</th>
          <th>Action</th>
        </thead>
        <tbody>
          @php
            $lists->load(['applicationModule'])
          @endphp
          @foreach ($lists as $k => $list)
          <tr class="fee-display-wrapper">
            <td>{{ $k+1 }}.</td>
            <td>{{ $list->applicationModule->name }}</td>
            <td>{{ $list->sub_app_type }}</td>
            <td>{{ $list->name }}</td>
            <td>{{ $list->period }}</td>
            <td>{{ $list->period_unit }}</td>
            <td>{{ $list->remark }}</td>
            <td>
              <a tr-id="{{ $k }}" class="fee-edit-button" href="{{ route('general_setup.periods.edit', $list) }}">Edit</a>
            </td>
          </tr>
          <tr style="display: none;background-color: #fafafa;" class="hide-tr-form-wrapper edit-form-{{  $k }}">
            <td colspan="7">
                <div class="col-md-8 offset-md-2">
                <form class="edit-form-wrapper" method="post" action="{{ route('general_setup.periods.update', $list) }}">
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
                    'name' => 'sub_app_type', 
                    'label' => 'Sub App Type('.implode(',', $applicationTypes).')', 
                    'value' => $list->sub_app_type, 
                    'placeholder' => '', 
                    'required' => 'required',
                    'selected'=> $list->sub_app_type,
                    'list' => $applicationTypes]" />

                  <x-forms.text-input :attrs="[
                    'name' => 'name', 
                    'required' => 'required', 
                    'value' => $list->name, 
                    'placeholder' => ' ', 
                    'label' => 'Name']" />

                    <x-forms.select-with-value-value :attrs="[
                    'name' => 'period', 
                    'label' => 'Period', 
                    'value' => $list->period, 
                    'placeholder' => '', 
                    'required' => 'required',
                    'selected'=> $list->period,
                    'list' => $periods]" /> 

                  <x-forms.select-with-value-value :attrs="[
                    'name' => 'period_unit', 
                    'label' => 'period_unit', 
                    'value' => $list->period_unit, 
                    'placeholder' => '', 
                    'required' => 'required',
                    'selected'=> $list->period_unit,
                    'list' => $periodUnits]" /> 

                  <x-forms.textarea :attrs="[
                    'name' => 'remark',
                    'value' => $list->remark, 
                    'placeholder' => '', 
                    'label' => 'Remark']" />
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