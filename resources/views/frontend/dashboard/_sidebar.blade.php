<!-- Sidebar -->
<aside class="col-md-3 nav-sticky dashboard-sidebar">
    <!-- User Info Section -->
    <div class="user-info text-center p-3">
        <img src="{{ asset( Auth::user()->image ) }}" alt="User Image" class="rounded-circle mb-2"
            style="width: 80px; height: 80px; object-fit: cover" />
        <h5 class="mb-0" style="color: #ff6f61">{{ Auth::user()->name }}</h5>
    </div>

    <!-- Sidebar Menu -->
    <div class="list-group profile-sidebar-menu">
        <a href="{{route('frontend.dashboard.profile')}}" class="list-group-item list-group-item-action {{$profile_active ?? ''}} menu-item"
            data-section="profile">
            <i class="fas fa-user"></i> Profile
        </a>
        <a href="{{route('frontend.dashboard.notifications')}}" class="list-group-item list-group-item-action {{$notify_active ?? ''}} menu-item"
            data-section="notifications">
            <i class="fas fa-bell"></i> Notifications
        </a>
        <a href="{{route('frontend.dashboard.setting')}}" class="list-group-item list-group-item-action {{$setting_active ?? ''}} menu-item" data-section="settings">
            <i class="fas fa-cog"></i> Settings
        </a>
        <a href="{{$getSetting->whatsapp}}" class="list-group-item list-group-item-action menu-item" data-section="settings">
            <i class="fa fa-question"></i> Support
        </a>
        <a href="javascript:void(0)" 
        onclick="if(confirm('Do You Want To Logout')){document.getElementById('profile-form-logout').submit()} return false;"
        class="list-group-item list-group-item-action menu-item" data-section="settings">
        <i class="fa fa-power-off" aria-hidden="true"></i> Logout
        </a>
        <form id="profile-form-logout" method="post" action="{{ route('logout') }}"> @csrf </form>
    </div>
</aside>