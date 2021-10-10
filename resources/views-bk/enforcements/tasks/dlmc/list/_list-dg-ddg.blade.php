<?php
    $indexer = $lists->perPage() * $lists->currentPage() - $lists->perPage();
    $directorId = App\Model\AccountSetup\RoleUser::getDirectorId();
    $dgOrddgIds = App\Model\AccountSetup\RoleUser::getDgOrddgIds();
?>

<div class="table-responsive">
    <table class="table table-bordered">

        <thead>
            <tr>
                <th style="width: 70px;">No.</th>
                <th>Application No.</th>
                <th>Factory Name</th>
                <th>Dosage Form Type</th>
                <th>Application Date</th>
                <th>Director Remark</th>
                <th style="width: 50px;"><input type="checkbox" class="select-all-cases" name="selectAll" value="selectAll" /></th>
                <td>Remark</td>
                <td>Officer</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($lists as $k => $list)
            @php
                $lastComment = $list->dlmcComments->where('from_officer_id', $directorId)->whereIn('to_officer_id', $dgOrddgIds)->sortDesc()->first();
                $directorComment = $lastComment? $lastComment->comment: '';
                $isMyCase = $list->dlmcActionRecord->assigned_officer_id  === auth()->user()->id;
            @endphp
            <tr class="application-tr">
                <td>{{ $k + 1 + $indexer }}.</td>
                <td>{{ $list->application_no }}</td>
                <td>{{ $list->manufacturer_name }}</td>
                <td>
                    {{ $list->dlmcDrugsToProduce->dosage_type?? 'N\A' }}
                </td>
                <td>{{ optional($list->dlmcActionRecord)->submitted_at }}</td>
                <td>{!! $directorComment !!}</td>
                <td>
                <input type="checkbox" class="individual-case cases" name="cases[{{ $list->id }}][caseId]" value="{{ $list->id }}" />
                </td>
                <td>
                    <textarea placeholder="Optional"
                        comment-box="comment-box-{{ $list->id }}"
                        class="form-control comment-box"
                        name="cases[{{ $list->id }}][comment]" ></textarea>
                                        </td>
                <td>{{ optional($list->dlmcActionRecord->user)->name }}</td>
                <td>
                    <!-- // has view permission -->
                    @if( auth()->user()->hasPermission('dlmc', 'view') )
                       <a class="btn btn-warning btn-sm" href="{{ route('tasks.dlmc.show', ['dlmcApplication' => $list]) }}">View</a>
                    @endif

                    @if( in_array(request('applicationStatus'),['submitted', 'resubmitted', 'license-approved']) )

                    @if( $isMyCase )
                        @if( auth()->user()->hasPermission('dlmc', 'to-approve') )
                            <a class="btn btn-sm btn-success each-dg-action mt-1"
                            style="margin-bottom: 4px;width: 80px;height: auto;padding: 5px;"
                            case-id="{{ $list->id }}"
                            case-text="To Approve"
                            action-type="to-approve"
                            case-type="single"
                            redirect-url="{{ url()->full() }}"
                            href="{{ route('tasks.dlmc.decisional_action') }}">To Approve</a>
                        @endif

                        @if( auth()->user()->hasPermission('dlmc', 'to-reject') )
                            <a class="btn btn-sm btn-danger no-alert each-dg-action"
                            case-id="{{ $list->id }}"
                            case-text="To Reject"
                            action-type="to-reject"
                            case-type="single"
                            redirect-url="{{ url()->full() }}"
                            style="margin-bottom: 4px;width: 80px;height: auto;padding: 5px;"
                            href="{{ route('tasks.dlmc.decisional_action') }}">To Reject</a>
                        @endif
                    @endif

                @endif

                </td>
            </tr>
            @endforeach

            @if( count($lists) > 0  && in_array(request('applicationStatus'),['submitted', 'resubmitted']) && request('taskType') === 'myTasks')
                <tr>
                    <td colspan="10">
                        <input type="hidden" name="actionType" class="actionType" />
                        @if ( auth()->user()->hasPermission('dlmc', 'to-reject') )
                        <button type="button" disabled="disabled"
                          name="actionTypes"
                          value="to-reject-all"
                          url="{{ route('tasks.dlmc.decisional_action') }}"
                          redirect-url="{{ url()->full() }}"
                          case-text="To Reject all"
                          class="btn btn-sm btn-danger reject-all-button group-action-button no-alert"
                          style="margin-bottom: 4px;float: right;height: auto;padding: 7px 5px;">To Reject All</button>
                        @endif

                        @if ( auth()->user()->hasPermission('dlmc', 'to-approve') )
                        <button type="button" disabled="disabled" name="actionTypes"
                          value="to-approve-all"
                          url="{{ route('tasks.dlmc.decisional_action') }}"
                          redirect-url="{{ url()->full() }}"
                          case-text="To Approve all"
                          class="btn btn-sm btn-success approve-all-button group-action-button"
                          style="margin-bottom: 4px;margin-left: 5px;float: right;height: auto;padding: 7px 5px;">To Approve All</button>
                        @endif

                    </td>
                </tr>
            @endif

        </tbody>

    </table>
</div>

{{ $lists->appends(request()->all()) }}

@section('js')
  @parent
  <script>
     OFFICER_ACTION().init();
  </script>
@endsection
