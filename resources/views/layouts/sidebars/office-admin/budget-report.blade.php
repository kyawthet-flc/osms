<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 
    <i class="menu-icon fa fa-tasks"></i>Budget Report</a>
    <ul class="sub-menu children dropdown-menu show">

      @if( auth()->user()->hasPermission('diac', 'budget-reporting') )
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.diac.budget_report') }}">DIAC</a>
      </li>
      @endif

      @if( auth()->user()->hasPermission('drc', 'budget-reporting') )
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc.budget_report') }}">DRC</a>
      </li>
      @endif

      @if( auth()->user()->hasPermission('drc-local', 'budget-reporting') )
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.drc_local.budget_report') }}">DRC Local</a>
      </li>
      @endif

      @if( auth()->user()->hasPermission('dlmc', 'budget-reporting') )
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.dlmc.budget_report') }}">Local manufacturer</a>
      </li>
      @endif

      @if( auth()->user()->hasPermission('onetime', 'budget-reporting') )
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('tasks.onetime.budget_report') }}">Onetime</a>
      </li>
      @endif
 
  </ul>
</li>