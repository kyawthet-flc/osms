<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="{{route('home')}}"><img src="{{asset('images/FDAlogo.png')}}" alt="Logo" width="50px;"> &nbsp; Dashboard</a>
            <a class="navbar-brand hidden" href="{{route('home')}}"><img src="{{asset('images/FDAlogo.png')}}" alt="Logo" width="50px"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav sidebar-nav">

            @auth

              @if( auth()->user()->isSuperAdmin() )
                @include('layouts.sidebars.super-admin.account-setup')
                @include('layouts.sidebars.super-admin.general-setup')
                @include('layouts.sidebars.super-admin.product-setup')
                @include('layouts.sidebars.super-admin.system-log')
              @else

                @if( auth()->user()->isOfficer() )
                  @includeIf('layouts.sidebars.office-admin.tasks')
                  @includeIf('layouts.sidebars.office-admin.application-report')
                  @includeIf('layouts.sidebars.office-admin.budget-report')
                @endif

                @if( auth()->user()->isLabAdmin() )
                  @includeIf('layouts.sidebars.lab-admin.tasks')
                @endif

              @endif
            @endauth
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
