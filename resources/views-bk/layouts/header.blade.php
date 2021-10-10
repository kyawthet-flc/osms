<!-- Header-->
<header id="header" class="header">

    <div class="header-menu">

        <div class="col-sm-7">
            <!-- <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a> -->
            <div class="header-left">
              <!--  {{--  @include('layouts.utils.search_bar') --}} -->
              @include('layouts.utils.notificaitons')
              <!-- {{-- @include('layouts.utils.emails') --}} -->
            </div>
        </div>

        <div class="col-sm-5 text-right">
            <div class="admin-info">
            {{ ucwords(auth()->user()->name) }}
            </div>
            <div class="user-area dropdown float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <!-- <img class="user-avatar rounded-circle" src="{{asset('images/admin.jpg')}}" alt="User Avatar"> -->
                    <i class="fa fa-cog" style="font-size: 30px;
                    margin-top: 5px;
                    color: dodgerblue;"></i>
                </a>

                <div class="user-menu dropdown-menu">
                    <a class="nav-link" href="{{ route('change_password') }}"><i class="fa fa-user"></i> Change Password</a>

                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('admin-logout-form').submit();">
                        <i class="fa fa-power-off"></i> Logout
                    </a>

                    <form id="admin-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                </div>
            </div>
           <!-- {{-- @include('layouts.utils.language') --}} -->

        </div>
    </div>

</header><!-- /header -->
<!-- Header-->
