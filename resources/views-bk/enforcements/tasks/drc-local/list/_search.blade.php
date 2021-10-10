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
                <x-forms.text-input :attrs="['name' => 'certificate_no', 'value' => request('certificate_no'), 'placeholder' => 'Certificate No.']" />
            </div>
        @endif

        <div class="col-md-4">
            <x-forms.text-input :attrs="['name' => 'application_no', 'value' => request('application_no'), 'placeholder' => 'Application No.']" />
        </div>

        <div class="col-md-4">
            <x-forms.text-input :attrs="['name' => 'submitted_at', 'class' =>'daterangepicker-lib', 'value' => request('submitted_at'), 'placeholder' => 'Application Date']" />
        </div>


        @if( in_array(request('applicationStatus'), ['resubmitted']))
        <!--   <div class="col-md-4">
                <x-forms.text-input :attrs="['name' => 'incomplete_at', 'class' =>'daterangepicker-lib', 'value' => request('incomplete_at'), 'placeholder' => 'Incomplete Date']" />
            </div>
            <div class="col-md-4">
                <x-forms.text-input :attrs="['name' => 'resubmitted_at', 'class' =>'daterangepicker-lib', 'value' => request('resubmitted_at'), 'placeholder' => 'Resubmission Date']" />
            </div> -->
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

        @if( in_array(request('applicationStatus'), ['submitted', 'resubmitted']) )

            <div class="col-md-4">
                <label for="" class="col-md-12 pl-1 mb-0"><b>Lab Status</b></label>
                <label for="lab_status_all">
                    <input type="radio" name="lab_status" id="lab_status_all" value="lab_status_all"
                    @if(request('lab_status', 'lab_status_all') =='lab_status_all') checked="checked" @endif /> All
                </label>
                <label for="to_request">
                    <input type="radio" name="lab_status" id="to_request" value="to_request"
                    @if(request('lab_status') =='to_request') checked="checked" @endif /> Not Requested
                </label>
                <label for="requested">
                    <input type="radio" name="lab_status" id="requested" value="requested"
                    @if(request('lab_status') =='requested') checked="checked" @endif /> Requested
                </label>
                <label for="received">
                    <input type="radio" name="lab_status" id="received" value="received"
                    @if(request('lab_status') =='received') checked="checked" @endif /> Received
                </label>
            </div>
        @endif

        <div class="col-md-12 text-right mt-5">
            <button type="submit" class="btn btn-success form-action-btn" name="action" value="search">Search</button>
            <a href="{{ route('tasks.drc_local.index',['applicationType' => request('applicationType'), 'applicationStatus' => request('applicationStatus'), 'ipp' => request('ipp'), 'taskType' => request('taskType')]) }}" class="btn btn-danger no-alert">Clear</a>
        </div>


        @if( !in_array(request('applicationStatus'), ['incomplete', 'auto-cancelled', 'approved', 'rejected']) )
            @php
                $returnFromDgCount =  auth()->user()->isDirector()? auth()->user()->directorDrcLocalDecisionCaseCount(request('applicationType'), request('applicationStatus')): 0;
            @endphp
            <div class="col-md-12">
                <label><input type="radio" onChange="this.form.submit();" name="taskType" checked="checked" value="myTasks" /> My Tasks {!! caseCounter( $drcLocalTasksByAppStatus[request('applicationStatus')] - $returnFromDgCount) !!}</label>
                <label><input type="radio" onChange="this.form.submit();" name="taskType" @if(request('taskType') === 'allTasks') checked="checked" @endif value="allTasks" /> All {!! caseCounter($drcLocalCommonCountArr[request('applicationStatus')]) !!}</label>

                @if( auth()->user()->isDirector() )
                    <label><input type="radio" onChange="this.form.submit()" name="taskType" @if(request('taskType') === 'returnFromDG') checked="checked" @endif value="returnFromDG" />
                        Return Cases From DG {!! caseCounter(auth()->user()->drcLocalDDGCount(request('applicationType'), request('applicationStatus'))) !!}
                    </label>
                @endif

                @if( auth()->user()->isDeputyDirectorGeneral() || auth()->user()->isDirectorGeneral() )
                    <label>
                        <input type="radio" onChange="this.form.submit()" name="taskType" @if(request('taskType') === 'recentDecision') checked="checked" @endif value="recentDecision" />
                        Recent To Approve or To Reject
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
