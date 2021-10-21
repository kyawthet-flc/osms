<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="{{ asset('images/user-avatar.png') }}" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{ ucwords(auth()->user()->display_name) }}</p>
            <!-- <div>
              <span class="status-indicator online"></span>
              <small class="designation text-muted">Role Level</small>
            </div> -->
          </div>
        </div> 
      </div>
    </li>
    
    @include('layouts.sidebars.client-menu')

   {{-- @if( true )
       @include('layouts.sidebars.super-admin.account-setup')
       @include('layouts.sidebars.super-admin.general-setup')
       @include('layouts.sidebars.super-admin.product-setup')
       @include('layouts.sidebars.super-admin.system-log')
    @endif

    @if( true )
       @includeIf('layouts.sidebars.office-admin.application-report')
    @endif
    @if( true )
       @includeIf('layouts.sidebars.office-admin.budget-report')
    @endif  --}}

  </ul>
</nav>

