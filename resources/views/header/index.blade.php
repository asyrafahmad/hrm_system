<!-- Header -->
<div class="header">
    <!-- Logo -->
    <div class="header-left">
        <a href="{{ route('dashboard.admin') }}" class="logo">
            <img src="{{ URL::to('assets/img/signature-logo.png') }}" width="140" height="40" alt="">
        </a>
    </div>
    <!-- /Logo -->
    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon"><span></span><span></span><span></span></span>
    </a>
    <!-- Header Title -->
    <div class="page-title-box">
        <h3>{{ Auth::user()->name }}</h3>
    </div>
    <!-- /Header Title -->
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
    <!-- Header Menu -->
    <ul class="nav user-menu">
        <!-- Search -->
        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search"> <i class="fa fa-search"></i> </a>
                <form action="search.html">
                    <input class="form-control" type="text" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </li>
        <!-- /Search -->
        <!-- Flag -->
        <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button">
                <img src="{{ URL::to('assets/img/flags/us.png') }}" alt="" height="20">
                <span>English</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ URL::to('assets/img/flags/my.png') }}" alt="" height="16"> Malaysia
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ URL::to('assets/img/flags/us.png') }}" alt="" height="16"> English
                </a>
            </div>
        </li>
        <!-- /Flag -->
        <!-- User Profile -->
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img">
                    <img src="{{ URL::to('/assets/images/'. Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}">
                    <span class="status online"></span>
                </span>
                <span>{{ Auth::user()->name }}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('profile_user') }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('company/settings/page') }}">Settings</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->
</div>
<!-- /Header -->