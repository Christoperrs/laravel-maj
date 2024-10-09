<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tooling Digital</title>
    
    <!-- Required meta tags -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <title>@yield('title', 'Dashboard')</title>
    
    <style>
        html, body {
            height: 100%;
        }

        .dashboard-main-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .dashboard-wrapper {
            flex: 1;
            margin-left: 250px;
        }

        .footer {
            background-color: #fff;
            padding: 10px 20px;
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 10;
        }
    </style>
</head>
<body>
    <div class="dashboard-main-wrapper">
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="index.html">
                    <img src="{{ asset('assets/images/logos.png') }}" alt="Logo" style="height: 40px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notification</div>
                                    <div class="notification-list"></div>
                                </li>
                                <li>
                                    <div class="list-footer"><a href="#">View all notifications</a></div>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <div class="conntection-footer"><a href="#">More</a></div>
                            </ul>
                        </li>
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="assets/images/avatar-1.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham</h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-power-off mr-2"></i>Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">Menu</li>
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ route('home') }}"><i class="fa fa-fw fa-user-circle"></i>Dashboard</a>
                            </li>
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                @canany(['create-role', 'edit-role', 'delete-role'])
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('roles.index') }}"><i class="fa fa-fw fa-rocket"></i>Manage Roles</a>
                                    </li>
                                @endcanany
                                @canany(['create-user', 'edit-user', 'delete-user'])
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-fw fa-user-circle"></i>Manage Users</a>
                                    </li>
                                @endcanany
                                @canany(['create-product', 'edit-product', 'delete-product'])
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('products.index') }}"><i class="fas fa-fw fa-table"></i>Manage Products</a>
                                    </li>
                                @endcanany
                                @can('view-product')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('products.index') }}"><i class="fab fa-fw fa-wpforms"></i>View Products</a>
                                    </li>
                                @endcan
                                @can('view-part')
                                    @isset($product)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('products.parts.index', $product->id) }}"><i class="fas fa-fw fa-inbox"></i>Manage Parts</a>
                                        </li>
                                    @endisset
                                @endcan
                                <!-- Maintenance Link -->
                                @can('view-maintenance')
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('maintenance.index') }}"><i class="fas fa-fw fa-chart-pie"></i>Manage Maintenance</a>
                                    </li>
                                @endcan
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        
        <div class="dashboard-wrapper">
            <div class="container-fluid dashboard-content">
                @yield('content')
            </div>
        </div>

        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <p class="text-center">Copyright © 2024 - Tooling Digital</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/libs/js/main-js.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/chartist-bundle/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/morris-bundle/raphael.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/morris-bundle/morris.js') }}"></script>
    <script src="{{ asset('assets/vendor/charts/c3charts/c3.min.js') }}"></script>
    <script src="{{ asset('assets/libs/js/dashboard-ecommerce.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery/jquery.validate.min.js') }}"></script>
</body>
</html>
