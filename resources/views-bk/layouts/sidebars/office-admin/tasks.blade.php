@php
   $diacTasksByAppType = auth()->user()->diacTasksByAppType();
   $drcTasksByAppType = auth()->user()->drcTasksByAppType();
   $drcLocalTasksByAppType = auth()->user()->drcLocalTasksByAppType();
   $dlmcTasksByAppType = auth()->user()->dlmcTasksByAppType();
   $enforcementLabCounters = auth()->user()->enforcementLabCounters();
   $countInspectStatus = auth()->user()->countInspection();
   $onetimeTasksByAppType = auth()->user()->onetimeTasksByAppType();
@endphp
<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <i class="menu-icon fa fa-tasks"></i>DIAC</a>
    <ul class="sub-menu children dropdown-menu show">
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.diac.index',['applicationType' => 'new', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks'
         ]) }}">New {!! caseCounter($diacTasksByAppType['new']) !!}</a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.diac.index',['applicationType' => 'amend', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks']) }}">
          Amendment {!! caseCounter($diacTasksByAppType['amend']) !!}
        </a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.diac.index',['applicationType' => 'renew', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks']) }}">
          Renewal {!! caseCounter($diacTasksByAppType['renew']) !!}
        </a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.diac.index',['applicationType' => 'amend', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks', 'hasExtension' => 'yes',]) }}">
          Extension {!! caseCounter($diacTasksByAppType['extension']) !!}
        </a>
      </li>
  </ul>
</li>

<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <i class="menu-icon fa fa-tasks"></i>DRC(Import)</a>
    <ul class="sub-menu children dropdown-menu show">
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc.index',['applicationType' => 'new', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks'
         ]) }}">New {!! caseCounter($drcTasksByAppType['new']) !!}</a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc.index',['applicationType' => 'amend', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks']) }}">
          Amendment {!! caseCounter($drcTasksByAppType['amend']) !!}
        </a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc.index',['applicationType' => 'renew', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks']) }}">
        Renewal {!! caseCounter($drcTasksByAppType['renew']) !!}
        </a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc.lab_index',['labTypeStatus' => 'to_request']) }}">
        Lab {!! caseCounter($enforcementLabCounters['drc']) !!}
        </a>
      </li>

  </ul>
</li>

<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <i class="menu-icon fa fa-tasks"></i>DRC(Local)</a>
    <ul class="sub-menu children dropdown-menu show">
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc_local.index',['applicationType' => 'new', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks'
         ]) }}">New {!! caseCounter($drcLocalTasksByAppType['new']) !!}</a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc_local.index',['applicationType' => 'amend', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks']) }}">
          Amendment {!! caseCounter($drcLocalTasksByAppType['amend']) !!}
        </a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc_local.index',['applicationType' => 'renew', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks']) }}">
          Renewal {!! caseCounter($drcLocalTasksByAppType['renew']) !!}
        </a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc_local.lab_index', ['labTypeStatus' => 'to_request']) }}">
         Lab {!! caseCounter($enforcementLabCounters['drcLocal']) !!}
        </a>
      </li>
  </ul>
</li>

<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <i class="menu-icon fa fa-tasks"></i>Local Manufacturer</a>
    <ul class="sub-menu children dropdown-menu show">
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.dlmc.index',['applicationType' => 'new', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks'
         ]) }}">New {!! caseCounter($dlmcTasksByAppType['new']) !!}</a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.dlmc.index',['applicationType' => 'amend', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks']) }}">
          Amendment {!! caseCounter($dlmcTasksByAppType['amend']) !!}
        </a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.dlmc.index',['applicationType' => 'renew', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks']) }}">
        Renewal {!! caseCounter($dlmcTasksByAppType['renew']) !!}
        </a>
      </li>
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.dlmc.inspection.index', [ 'inspectionStatus' => 'inspect']) }}">
        Inspection {!! caseCounter($countInspectStatus) !!}
        </a>
      </li>
  </ul>
</li>

<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <i class="menu-icon fa fa-tasks"></i>Onetime</a>
    <ul class="sub-menu children dropdown-menu show">
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.onetime.index',['applicationType' => 'new', 'applicationStatus' => 'submitted', 'taskType' => 'myTasks'
         ]) }}">New {!! caseCounter($onetimeTasksByAppType['new']) !!}</a>
      </li>
  </ul>
</li>
