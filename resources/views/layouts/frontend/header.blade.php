<!-- Top Bar Start -->
<div class="top-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="tb-contact">
                    <p><i class="fas fa-envelope"></i>{{ $getSetting->email }}</p>
                    <p><i class="fas fa-phone-alt"></i>{{ $getSetting->phone }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="tb-menu">
                    {{-- <a href="">About</a>
            <a href="">Privacy</a>
            <a href="">Terms</a>
            <a href="{{route('frontend.contact.index')}}">Contact</a> --}}
                    @guest()
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endguest
                    @auth()
                        <a href="javascript:void(0)"
                            onclick="if(confirm('Do You Want To Logout')){document.getElementById('form-logout').submit()} return false;">Logout</a>
                    @endauth
                </div>
                <form id="form-logout" method="post" action="{{ route('logout') }}"> @csrf </form>

            </div>
        </div>
    </div>
</div>
<!-- Top Bar Start -->

<!-- Brand Start -->
<div class="brand">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-4">
                <div class="b-logo">
                    <a href="index.html">

                        <img src="{{ asset("assets/front-end/$getSetting->logo") }}" alt="Logo" />
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-4">
                <div class="b-ads">

                </div>
            </div>
            <div class="col-lg-3 col-md-4">
                <form action="{{ route('frontend.search') }}" method="post">
                    @csrf
                    <div class="b-search">
                        <input type="text" name="search" placeholder="Search" value="{{ old('search') }}" />
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div> 
</div>
<!-- Brand End -->

<!-- Nav Bar Start -->
<div class="nav-bar">
    <div class="container">
        <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <a href="#" class="navbar-brand">MENU</a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav mr-auto">
                    <a href="{{ url('') }}" class="nav-item nav-link active">Home</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                        <div class="dropdown-menu">
                            @foreach ($categories as $category)
                                <a href="{{ route('frontend.category.posts', $category->slug) }}"
                                    class="dropdown-item">{{ $category->name }}</a>
                            @endforeach

                        </div>
                    </div>
                    <a href="{{ route('frontend.dashboard.profile') }}" class="nav-item nav-link">Dashboard</a>
                    <a href="{{ route('frontend.contact.index') }}" class="nav-item nav-link">Contact Us</a>
                </div>
                <div class="social ml-auto">
                    <!-- Notification Dropdown -->
                    @auth
                        <a href="#" class="nav-link dropdown-toggle" id="notificationDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge badge-danger">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="notificationDropdown"
                            style="width: 300px;">
                            <div class="d-flex">
                                <h6 class="dropdown-header">Notifications</h6>
                                <a href="?readAll=readAll"
                                 style="background: none; width:70px;padding-top:6px;padding-left:5px;padding-right:5px;border:0">Read All</a>
                            </div>
                            @forelse (auth()->user()->unreadNotifications()->limit(3)->get() as $notification)
                                <div class="dropdown-item d-flex justify-content-between align-items-center">
                                    <span><a href="{{ $notification->data['post_link'] }}?notify={{ $notification->id }}"
                                            style="background: none">{{ $notification->data['user_name'] . ' ' . substr('commented on your post', 0, 15) }}...</a></span>
                                    {{-- <form action="" method="POST">
                               <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                           </form> --}}
                                </div>
                            @empty
                                <span>there are no notifications...</span>
                            @endforelse
                            <!-- <div class="dropdown-item text-center">No notifications</div>  -->
                        </div>
                    @endauth
                    <a href="{{ $getSetting->facebook }}"><i class="fab fa-facebook-f"></i></a>
                    <a href="{{ $getSetting->instagram }}"><i class="fab fa-instagram"></i></a>
                    <a href="{{ $getSetting->youtube }}"><i class="fab fa-youtube"></i></a>
                    {{-- <a href=""><i class="fab fa-twitter"></i></a> --}}
                    {{-- <a href=""><i class="fab fa-linkedin-in"></i></a> --}}
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Nav Bar End -->
