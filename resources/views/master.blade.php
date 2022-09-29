<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',env("APP_NAME"))</title>
    <link rel="icon" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head')
</head>
<body>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<nav class="navbar navbar-expand-lg navbar-light bg-white position-fixed top-0 w-100 shadow-sm" style="z-index: 5">
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('images/logo.png') }}" height="50" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest
                @auth
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset(auth()->user()->photo) }}" class="user-img rounded-circle shadow-sm border border-2 border-white me-2" alt="">
                            <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><span class="d-block d-md-none"><i class="fa fa-user me-2 text-primary"></i>{{ auth()->user()->name }}</span></li>
                            <li><a href="{{ route('edit-profile') }}" class="dropdown-item"><i class="fa-solid fa-user-cog me-2 text-success"></i>Edit Profile</a></li>
                            <li><a href="{{ route('change-password') }}" class="dropdown-item"><i class="fa-solid fa-key me-2 text-secondary"></i>Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt me-2 text-danger"></i>Log Out</a></li>
                        </ul>
                    </div>
                @endauth
            </ul>
        </div>
    </div>
</nav>
<div class="py-5"></div>
@yield('content')

<div class="py-4 bg-primary text-center text-white">
    &copy; {{ date('Y') }} All Rights Reserved.
</div>
<script src="{{ asset('js/app.js') }}"></script>
@stack('script')
</body>
</html>
