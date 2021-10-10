<x-forms.form-tag :attrs="[
    'id' => 'drug-search-form',
    'class' => 'drug-search-form',
    'method' => 'GET',
    'action' => url()->full() ]">

  <div class="row">
    
        <div class="col-md-4">
            @if( in_array(request('applicationStatus'), [ 'approved']) )

                <x-forms.select-with-key-value :attrs="[
                    'name' => 'orderBy',
                    'selected'=> request('orderBy')?? '',
                    'list' => [
                        'certificate_serial' => 'Certificate No.',
                        'application_serial' => 'Application No.',
                        'updated_at' => 'Last Editted Date',
                     ]]" 
                />

            @else 
                <x-forms.select-with-key-value :attrs="[
                    'name' => 'orderBy',
                    'selected'=> request('orderBy')?? '',
                    'list' => ['application_serial' => 'Application No.', 'updated_at' => 'Last Editted Date']]" 
                />
            @endif
        </div>

        <input type="hidden" name="applicationType" value="{{ request('applicationType') }}" />
        <input type="hidden" name="applicationStatus" value="{{ request('applicationStatus') }}" />
        
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

        @if( in_array(request('applicationStatus'), [ 'approved']))
            <div class="col-md-4">
                <x-forms.text-input :attrs="['name' => 'certificate_no', 'value' => request('certificate_no'), 'placeholder' => 'Certificate No.']" />
            </div>
        @endif

         <div class="col-md-4">
            <x-forms.text-input :attrs="['name' => 'application_no', 'value' => request('application_no'), 'placeholder' => 'Application No.']" />
        </div>

        <div class="col-md-4">
            <x-forms.text-input :attrs="['name' => 'dosage_type', 'value' => request('dosage_type'), 'placeholder' => 'Dosage Form Type']" />
        </div>

        <div class="col-md-4">
            <x-forms.text-input :attrs="['name' => 'manufacturer_name', 'value' => request('manufacturer_name'), 'placeholder' => 'Factory Name']" />
        </div>

        <div class="col-md-4"> 
            <x-forms.text-input :attrs="['name' => 'submitted_at', 'class' =>'daterangepicker-lib', 'value' => request('submitted_at'), 'placeholder' => 'Application Date']" />
        </div>

        @if( in_array(request('applicationStatus'), ['resubmitted']))
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'incomplete_at', 'class' =>'daterangepicker-lib', 'value' => request('incomplete_at'), 'placeholder' => 'Incomplete Date']" />
            </div>
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'resubmitted_at', 'class' =>'daterangepicker-lib', 'value' => request('resubmitted_at'), 'placeholder' => 'Resubmission Date']" />
            </div>
        @endif

        @if( in_array(request('applicationStatus'), [ 'incomplete']))
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'incomplete_at', 'class' =>'daterangepicker-lib', 'value' => request('incomplete_at'), 'placeholder' => 'Incomplete Date']" />
            </div>
        @endif

        @if( in_array(request('applicationStatus'), ['auto-cancelled']))
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'auto_cancelled_at', 'class' =>'daterangepicker-lib', 'value' => request('auto_cancelled_at'), 'placeholder' => 'Auto Cancelled Date']" />
            </div>
        @endif
        
        @if( in_array(request('applicationStatus'), ['rejected']))
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'rejected_at', 'class' => 'daterangepicker-lib', 'value' => request('rejected_at'), 'placeholder' => 'Rejected Date']" />
            </div>
        @endif

        @if( in_array(request('applicationStatus'), ['license-approved']))
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'temp_license_at', 'class' =>'daterangepicker-lib', 'value' => request('approved_at'), 'placeholder' => 'Approved Date']" />
            </div>
        @endif

        @if( in_array(request('applicationStatus'), ['approved']))
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'approved_at', 'class' =>'daterangepicker-lib', 'value' => request('approved_at'), 'placeholder' => 'Approved Date']" />
            </div>
        @endif
        
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success form-action-btn" name="action" value="search">Search</button>
            {{-- <a href="{{ request()->fullUrlWithQuery( ['applicationType' => request('applicationType'), 'applicationStatus' => request('applicationStatus')]) }}" class="btn btn-danger no-alert">Clear</a> --}}
            <a href="{{ route('tasks.dlmc.index',['applicationType' => request('applicationType'), 'applicationStatus' => request('applicationStatus'), 'taskType' => request('taskType') ]) }}" class="btn btn-danger no-alert">Clear</a>
        </div>

        
        @if( !in_array(request('applicationStatus'), ['incomplete', 'auto-cancelled', 'approved', 'rejected']) )
            @php
                $returnFromDgCount =  auth()->user()->isDirector()? auth()->user()->dlmcDirectorDecisionCaseCount(request('applicationType'), request('applicationStatus')): 0;
            @endphp
            <div class="col-md-12">
                <label><input type="radio" onChange="this.form.submit();" name="taskType" checked="checked" value="myTasks" /> My Tasks {!! caseCounter( $dlmcTasksByAppStatus[request('applicationStatus')] - $returnFromDgCount) !!}</label>
                <label><input type="radio" onChange="this.form.submit();" name="taskType" @if(request('taskType') === 'allTasks') checked="checked" @endif value="allTasks" /> All {!! caseCounter($dlmcCommonCountArr[request('applicationStatus')]) !!}</label>
                @if (auth()->user()->isDeputyDirectorGeneral() || auth()->user()->isDirectorGeneral())
                    @php
                        $directorUser = App\User::where('name', 'director')->first();
                    @endphp
                    <label><input type="radio" onChange="this.form.submit()" name="taskType" @if(request('taskType') === 'returnFromDG') checked="checked" @endif value="returnFromDG" />
                       Recent {!! caseCounter($directorUser->dlmcDirectorDecisionCaseCount(request('applicationType'), request('applicationStatus'))) !!}
                    </label>
                @endif
                @if( auth()->user()->isDirector() )
                    <label><input type="radio" onChange="this.form.submit()" name="taskType" @if(request('taskType') === 'returnFromDG') checked="checked" @endif value="returnFromDG" />
                        Return Cases From DG {!! caseCounter(auth()->user()->dlmcDirectorDecisionCaseCount(request('applicationType'), request('applicationStatus'))) !!}
                    </label>
                @endif
            </div>
        @endif
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
