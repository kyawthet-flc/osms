<x-forms.form-tag :attrs="[
    'id' => 'drug-search-form',
    'class' => 'drug-search-form',
    'method' => 'GET',
    'action' => url()->full() ]">

    <div class="row">
        <div class="col-md-4">
            <x-forms.select-with-key-value :attrs="[
                'name' => 'direction',
                'label' => '',
                'value' => '',
                'placeholder' => '',
                'selected'=> request('direction')?? '',
                'list' => [
                    'desc' => 'DESC',
                    'asc' => 'ASC',
                ]], " />
        </div>
        <input type="hidden" name="inspectionStatus" value="{{ request('inspectionStatus') }}" />

         <div class="col-md-4">
            <x-forms.text-input :attrs="['name' => 'application_no', 'value' => request('application_no'), 'placeholder' => 'Application No.']" />
        </div>

        <div class="col-md-4">
            <x-forms.text-input :attrs="['name' => 'manufacturer_name', 'value' => request('manufacturer_name'), 'placeholder' => 'Factory Name']" />
        </div>
       
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success form-action-btn" name="action" value="search">Search</button>
            <a href="{{ route('tasks.dlmc.inspection.index', [ 'inspectionStatus' => request('inspectionStatus')]) }}" class="btn btn-danger no-alert">Clear</a>
        </div>

        
    </div>
</x-forms.form-tag>

@section('css')
    @parent
    <style type="text/css">
        #drug-search-form {
            margin-bottom: 20px;
        }
        label {
            padding: 3px 5px;
        }
    </style>
@endsection
