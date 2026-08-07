@push('styles')
    <link rel="stylesheet" href="{{ asset('css/components/default/header.css') }}">
@endpush

<div class="navbar-bg" style="background: linear-gradient(135deg, #0B1F3A 0%, #123E73 50%, #1E5AA8 100%) !important; opacity: 0.95;"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                <div class="d-sm-none d-lg-inline-block">Hi, {{ Session('name') }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <!--<div class="dropdown-title">Logged in 5 min ago</div>-->
                <a href="{{ route('profile.index', Session('user_id')) }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
