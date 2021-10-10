<ul class="nav nav-tabs">
  
    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.dlmc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'submitted']) }}">Verify {!! caseCounter( $dlmcTasksByAppStatus['submitted']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.dlmc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'resubmitted']) }}">Return Cases {!! caseCounter($dlmcTasksByAppStatus['resubmitted']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.dlmc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'incomplete']) }}">Incomplete {!! incompleteCaseCounter($dlmcCommonCountArr['incomplete']) !!}</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.dlmc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'license-approved']) }}">Licence Approved {!! caseCounter($dlmcTasksByAppStatus['license-approved']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.dlmc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'auto-cancelled']) }}">Auto Cancelled {!! autoCancelledCaseCounter($dlmcCommonCountArr['auto-cancelled']) !!}</a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="{{ route('tasks.dlmc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'rejected']) }}">Rejected {!! rejectedCaseCounter($dlmcCommonCountArr['rejected']) !!}</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('tasks.dlmc.index', ['applicationType' => request('applicationType'), 'applicationStatus' => 'approved']) }}">Approved {!! approvedCaseCounter($dlmcCommonCountArr['approved']) !!}</a>
    </li>

  </ul>
<br>
