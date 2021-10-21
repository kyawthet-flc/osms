<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background: #128EFB;">
    <a class="navbar-brand brand-logo" href="{{ url('admin.index') }}">
      <img src="{{ asset('images/fda-logo.png') }}" alt="logo" style="height: 35px;width: 35px" />
    </a>
    <a class="navbar-brand brand-logo-mini" href="{{ url('admin.index') }}">
      <img  src="{{ asset('images/fda-logo.png') }}" alt="logo" style="height: 35px;width: 35px" /> </a>
  </div>

  <div class="navbar-menu-wrapper d-flex align-items-center">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="mdi mdi-menu"></span>
    </button>
    <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
      
    </ul>
    <ul class="navbar-nav navbar-nav-right">
      <li class="nav-item dropdown ml-4">
        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
          <i class="mdi mdi-bell-outline"></i>
          <span class="count bg-success">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="notificationDropdown">
          <a class="dropdown-item py-3 border-bottom" href="{{url('admin_unread_notifications')}}">
            <p class="mb-0 font-weight-medium float-left">You have  0 new notifications </p>
            <span class="badge badge-pill badge-primary float-right">View all</span>
          </a>
        </div>
      </li>
      
       <!-- Profile nav -->
       <li class="nav-item dropdown d-none d-xl-inline-block">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <span class="profile-text">{{ ucwords(auth()->user()->display_name) }}</span>
          <img class="img-xs rounded-circle" src="{{ asset('images/user-avatar.png') }}" alt="Profile image"> 
        </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
      
          <a href="{{ route('profile') }}" class="dropdown-item" >
            <i class="mdi mdi-account-settings-variant"></i> {{ __('Profile') }}
          </a>
          <a href="{{ route('change_password') }}" class="dropdown-item" >
            <i class="mdi mdi-textbox-password"></i> {{ __('Change Password') }}
          </a>
           <hr/>
          <a href="{{ route('logout') }}" class="dropdown-item"
            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            <i class="mdi mdi-logout"></i> {{ __('Sign Out') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
          <!-- Logout -->
        </div>
      </li>

    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>