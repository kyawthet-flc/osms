<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 
    <i class="menu-icon fa fa-tasks"></i>Application Report</a>
    <ul class="sub-menu children dropdown-menu show">

      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{url('medical.index', ['type'  => 'new', 'status' => 'submitted'])}}">DRC</a>
      </li>

      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{url('medical.index', ['type'  => 'amend', 'status' => 'submitted'])}}">DIAC</a>
      </li>
 
  </ul>
</li>