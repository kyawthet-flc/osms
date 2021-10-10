<x-forms.form-tag :attrs="[
    'id' => 'drug-search-form', 
    'class' => 'drug-search-form', 
    'method' => 'GET', 
    'action' => url()->full() ]">
    
  <div class="row">

        <div class="col-md-2">
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
 
        <div class="col-md-2">
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
                <x-forms.text-input :attrs="['name' => 'certificate_no', 'value' => request('certificate_no'), 'placeholder' => 'Application No.']" />
            </div>
        @endif
        
        <div class="col-md-4"> 
            <x-forms.text-input :attrs="['name' => 'application_no', 'value' => request('application_no'), 'placeholder' => 'Application No.']" />
        </div>

        {{-- <div class="col-md-4"> 
            <x-forms.text-input :attrs="['name' => 'drug_name', 'value' => request('drug_name'), 'placeholder' => 'Drug Name']" />
        </div> --}}
        <div class="col-md-4"> 
            <x-forms.text-input :attrs="['name' => 'brand_name', 'value' => request('brand_name'), 'placeholder' => 'Brand Name']" />
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

        @if( in_array(request('applicationStatus'), ['approved']))
            <div class="col-md-4"> 
                <x-forms.text-input :attrs="['name' => 'approved_at', 'class' =>'daterangepicker-lib', 'value' => request('approved_at'), 'placeholder' => 'Approved Date']" />
            </div>
        @endif

        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-success form-action-btn" name="action" value="search">Search</button>
            <a href="{{ route('tasks.onetime.index',['applicationType' => request('applicationType'), 'applicationStatus' => request('applicationStatus'), 'taskType' => request('taskType')]) }}" class="btn btn-danger no-alert">Clear</a>
        </div>     
 

        @if( !in_array(request('applicationStatus'), ['incomplete', 'auto-cancelled', 'approved', 'rejected']) )
            
            @php
              $returnFromDgCount =  auth()->user()->isDirector()? auth()->user()->onetimeDirectorDecisionCaseCount(request('applicationType'), request('applicationStatus')): 0;
            @endphp
            <div class="col-md-12">
                <label>
                    <input type="radio" onChange="this.form.submit();" name="taskType" checked="checked" value="myTasks" /> 
                    My Tasks {!! caseCounter( $onetimeTasksByAppStatus[request('applicationStatus')] - $returnFromDgCount ) !!}</label>
                <label>
                    <input type="radio" onChange="this.form.submit();" name="taskType" @if(request('taskType') === 'allTasks') checked="checked" @endif value="allTasks" />
                     All {!! caseCounter($onetimeCommonCountArr[request('applicationStatus')]) !!}
                </label>
                  
                @if( auth()->user()->isDirector() )
                    <label>
                        <input type="radio" onChange="this.form.submit()" name="taskType" @if(request('taskType') === 'returnFromDG') checked="checked" @endif value="returnFromDG" /> 
                        Return Cases From DG {!! caseCounter($returnFromDgCount) !!}
                    </label>
                @endif

                @if( auth()->user()->isDeputyDirectorGeneral() || auth()->user()->isDirectorGeneral() )
                    <label>
                        <input type="radio" onChange="this.form.submit()" name="taskType" @if(request('taskType') === 'recentDecision') checked="checked" @endif value="recentDecision" /> 
                        Recent To Approve or To Reject {!! caseCounter($returnFromDgCount) !!}
                    </label>
                    @php
                      $days = array(
                          ['value' => date('Y-m-d', strtotime(date('Y-m-d') . ' -1 day')), 'text' => 'Last 1 Day'],
                          ['value' => date('Y-m-d', strtotime(date('Y-m-d') . ' -2 day')), 'text' => 'Last 2 Day'],
                          ['value' => date('Y-m-d', strtotime(date('Y-m-d') . ' -3 day')), 'text' => 'Last 3 Day'],
                          ['value' => date('Y-m-d', strtotime(date('Y-m-d') . ' -4 day')), 'text' => 'Last 4 Day'],
                          ['value' => date('Y-m-d', strtotime(date('Y-m-d') . ' -5 day')), 'text' => 'Last 5 Day'],
                          ['value' => date('Y-m-d', strtotime(date('Y-m-d') . ' -6 day')), 'text' => 'Last 6 Day'],
                          ['value' => date('Y-m-d', strtotime(date('Y-m-d') . ' -7 day')), 'text' => 'Last 7 Day']
                      );
                    @endphp

                    @if(request('taskType') === 'recentDecision')
                        <select name="createdAt" onChange="this.form.submit()">
                            <option value="{{ date('Y-m-d') }}">Today</option>
                           @foreach($days as $day)
                            <option value="{{ $day['value'] }}" 
                                @if( request('createdAt') ===  $day['value'] )
                                selected="selected"
                                @endif>{{ $day['text'] }}</option>
                           @endforeach
                        </select>
                    @endif
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