<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 
    <i class="menu-icon fa fa-tasks"></i>Application Report</a>
    <ul class="sub-menu children dropdown-menu show">

    @if( auth()->user()->hasPermission('diac', 'application-reporting') )
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.diac.application_report') }}">DIAC</a>
      </li>
      @endif

      @if( auth()->user()->hasPermission('drc', 'application-reporting') )
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc.application_report') }}">DRC</a>
      </li>
      @endif
      
      @if( auth()->user()->hasPermission('drc-local', 'application-reporting') )
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc_local.application_report') }}">DRC Local</a>
      </li>
      @endif

      @if( auth()->user()->hasPermission('dlmc', 'application-reporting') )
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.dlmc.application_report') }}">Local manufacturer</a>
      </li>
      @endif

      @if( auth()->user()->hasPermission('onetime', 'application-reporting') )
        <li>
          <i class="fa fa-tasks"></i>
          <a href="{{ route('tasks.onetime.application_report') }}">Onetime</a>
        </li>
      @endif
 
  </ul>
</li>