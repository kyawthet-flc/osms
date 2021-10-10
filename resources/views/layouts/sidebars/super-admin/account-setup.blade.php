<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 
    <i class="menu-icon fa fa-tasks"></i>Account Setup</a>
    <ul class="sub-menu children dropdown-menu show">
    
      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('account_setup.adminUsers.index') }}">Admin User</a>
      </li>

      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('account_setup.adminUsers.create') }}">New Admin User</a>
      </li>

      <li>
       <i class="fa fa-tasks"></i>
       <a href="{{ route('account_setup.roles.index') }}">Role</a>
     </li>

  </ul>
</li>
