<x-forms.form-tag :attrs="['id' => 'drug-search-form', 'class' => 'drug-search-form', 'method' => 'GET', 'action' => url()->full() ]">

  <div class="row">

        <div class="col-md-4">
           <x-forms.select-with-key-value :attrs="[
            'label' => 'Application Type',
            'name' => 'applicationType',
            'selected'=> request('applicationType')?? '',
            'list' => ['new' => 'New', 'renew' => 'Renewal']]" />
        </div>
 
        <input type="hidden" name="labTypeStatus" value="{{ request('labTypeStatus') }}" />

        <div class="col-md-4"> 
             <x-forms.text-input :attrs="['name' => 'application_no', 'label' => 'Application No.', 'value' => request('application_no'), 'placeholder' => 'Application No.']" />
        </div>
        
        <div class="col-md-4"> 
             <x-forms.text-input :attrs="['name' => 'application_date',  'class' => 'daterangepicker-lib', 'label' => 'Application Date', 'value' => request('application_date'), 'placeholder' => 'Application Date']" />
        </div>
        
        @if( 'requested' === request('labTypeStatus') )
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'lab_requested_at','class' => 'daterangepicker-lib', 'label' => 'Requested Date', 'value' => request('lab_requested_at'), 'placeholder' => 'Requested Date']" />
            </div>
        @endif

        @if( 'received' === request('labTypeStatus') )
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'lab_requested_at', 'class' => 'daterangepicker-lib', 'label' => 'Requested Date', 'value' => request('lab_requested_at'), 'placeholder' => 'Requested Date']" />
            </div>
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'lab_received_at', 'class' => 'daterangepicker-lib', 'label' => 'Received Date', 'value' => request('lab_received_at'), 'placeholder' => 'Received Date']" />
            </div>
        @endif 

        @if( 'result' === request('labTypeStatus') )
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'lab_requested_at', 'class' => 'daterangepicker-lib', 'label' => 'Requested Date', 'value' => request('lab_requested_at'), 'placeholder' => 'Requested Date']" />
            </div>
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'lab_received_at','class' => 'daterangepicker-lib',  'label' => 'Received Date', 'value' => request('lab_received_at'), 'placeholder' => 'Received Date']" />
            </div>
            <div class="col-md-4">
            <x-forms.select-with-key-value :attrs="[
                'label' => 'Lab Status',
                'name' => 'labStatus',
                'selected'=> request('labStatus')?? '',
                'list' => ['passed' => 'Passed', 'failed' => 'Failed']]" />
            </div>
        @endif       

        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success form-action-btn" name="action" value="search">Search</button>
            <a href="{{ request()->fullUrlWithQuery( ['applicationType' => request('applicationType'), 'labTypeStatus' => request('labTypeStatus')]) }}" class="btn btn-danger no-alert">Clear</a>
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
