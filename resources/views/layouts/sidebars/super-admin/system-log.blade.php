<li class="menu-item-has-children dropdown show">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> 
    <i class="menu-icon fa fa-tasks"></i>Application System Log</a>
    <ul class="sub-menu children dropdown-menu show">

      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('system_log.application.index') }}">Application Log</a>
      </li>

      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('system_log.mail.index') }}">Mail Log</a>
      </li>

      <li>
        <i class="fa fa-tasks"></i>
        <a href="{{ route('system_log.loginout.index') }}">LogIn/Out Log</a>
      </li>
 
  </ul>
</li>
