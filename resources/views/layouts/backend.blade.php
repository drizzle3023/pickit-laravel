<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Pick it</title>

    <meta name="description" content="Welcome to Pick it system">
    <meta name="author" content="James">
    <meta name="robots" content="noindex, nofollow">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" href="{{ mix('css/dashmix.css') }}">

    <!-- You can include a specific file from public/css/themes/ folder to alter the default color theme of the template. eg: -->
<!-- <link rel="stylesheet" href="{{ mix('css/themes/xwork.css') }}"> -->

    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
@yield('css_after')

<!-- Scripts -->
    <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
</head>
<body>
<!-- Page Container -->
<!--
    Available classes for #page-container:

GENERIC

    'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

SIDEBAR & SIDE OVERLAY

    'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
    'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
    'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
    'sidebar-dark'                              Dark themed sidebar

    'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
    'side-overlay-o'                            Visible Side Overlay by default

    'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

    'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

HEADER

    ''                                          Static Header if no class is added
    'page-header-fixed'                         Fixed Header


Footer

    ''                                          Static Footer if no class is added
    'page-footer-fixed'                         Fixed Footer (please have in mind that the footer has a specific height when is fixed)

HEADER STYLE

    ''                                          Classic Header style if no class is added
    'page-header-dark'                          Dark themed Header
    'page-header-glass'                         Light themed Header with transparency by default
                                                (absolute position, perfect for light images underneath - solid light background on scroll if the Header is also set as fixed)
    'page-header-glass page-header-dark'         Dark themed Header with transparency by default
                                                (absolute position, perfect for dark images underneath - solid dark background on scroll if the Header is also set as fixed)

MAIN CONTENT LAYOUT

    ''                                          Full width Main Content if no class is added
    'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
    'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
-->
<div id="page-container"
     class="sidebar-o enable-page-overlay side-scroll page-header-fixed page-header-dark main-content-narrow">
    <!-- Sidebar -->
    <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="bg-header-dark">
            <div class="content-header bg-white-10 header-div-logo">
                <!-- Logo -->
                <a class="font-w600 font-size-lg text-white" href="{{url('/dashboard')}}">
                    <img src="{{asset('/media/logo.png')}}" style="width: 80px;">
                    {{--                            <span class="text-white-75">Dash</span><span class="text-white">mix</span>--}}
                </a>
                <!-- END Logo -->

            </div>
        </div>
        <!-- END Side Header -->

        <!-- Side User Avatar -->
        <div class="bg-header-light">
            <div class="content-header bg-white-10 header-div-avatar">
                <a class="block block-rounded text-center bg-image header-a-avatar"
                   style="background-image: url({{asset('media/photos/Food1.jpg')}});" href="{{url('/profile')}}">
                    <div class="block-content bg-white-90">
                        <img class="img-avatar img-avatar-thumb"
                             src="{{asset('media/avatars').'/'.Session::get('user')->avatar}}" alt="">
                    </div>
                    <div class="block-content block-content-full bg-white-90">
                        <p class="font-w600 mb-0">{{Session::get('user')->first_name.' '.Session::get('user')->last_name}}</p>
                        <p class="font-size-sm font-italic text-muted mb-0">
                            @if(Session::get('user-type') === 1)
                                Ultimate User
                            @elseif(Session::get('user-type') === 2)
                                Employee
                            @else
                                Customer
                            @endif
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Side User Avatar -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                @if(Session::get('user-type')==3)
                    <li class="nav-main-heading">DASHBOARD</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('customers*') ? ' active' : '' }}"
                           href="{{url('/dashboard')}}">
                            <i class="nav-main-link-icon si si-pie-chart"></i>
                            <span class="nav-main-link-name">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-main-heading">CONTENT</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('product*') ? ' active' : '' }}"
                           href="{{url('/products')}}">
                            <i class="nav-main-link-icon far fa-edit"></i>
                            <span class="nav-main-link-name">Products</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('categories*') ? ' active' : '' }}"
                           href="{{url('/categories')}}">
                            <i class="nav-main-link-icon si si-notebook"></i>
                            <span class="nav-main-link-name">Categories</span>
                        </a>
                    </li>
                @else
                    <li class="nav-main-heading">DASHBOARD</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('dashboard') ? ' active' : '' }}"
                           href="{{url('/dashboard')}}">
                            <i class="nav-main-link-icon si si-pie-chart"></i>
                            <span class="nav-main-link-name">Overview</span>
                        </a>
                    </li>
                    @if(Session::get('user-type')==1)
                        <li class="nav-main-item">
                            <a class="nav-main-link{{ request()->is('employees*') ? ' active' : '' }}"
                               href="{{url('/employees')}}">
                                <i class="nav-main-link-icon far fa-user-circle"></i>
                                <span class="nav-main-link-name">Employees</span>
                            </a>
                        </li>
                    @endif
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('customers*') ? ' active' : '' }}"
                           href="{{url('/customers')}}">
                            <i class="nav-main-link-icon si si-emoticon-smile"></i>
                            <span class="nav-main-link-name">Clients</span>
                        </a>
                    </li>
                    {{--                        <li class="nav-main-item">--}}
                    {{--                            <a class="nav-main-link{{ request()->is('notification*') ? ' active' : '' }}" href="{{url('/notifications')}}">--}}
                    {{--                                <i class="nav-main-link-icon far fa-bell"></i>--}}
                    {{--                                <span class="nav-main-link-name">Notifications</span>--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    {{--                        <li class="nav-main-item">--}}
                    {{--                            <a class="nav-main-link{{ request()->is('message*') ? ' active' : '' }}" href="{{url('/messages')}}">--}}
                    {{--                                <i class="nav-main-link-icon far fa-comment-dots"></i>--}}
                    {{--                                <span class="nav-main-link-name">Messages</span>--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                    <li class="nav-main-heading">CONTENT</li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('product*') ? ' active' : '' }}"
                           href="{{url('/products')}}">
                            <i class="nav-main-link-icon far fa-edit"></i>
                            <span class="nav-main-link-name">Products</span>
                        </a>
                    </li>
                    <li class="nav-main-item">
                        <a class="nav-main-link{{ request()->is('categories*') ? ' active' : '' }}"
                           href="{{url('/categories')}}">
                            <i class="nav-main-link-icon si si-notebook"></i>
                            <span class="nav-main-link-name">Categories</span>
                        </a>
                    </li>
                    {{--                        <li class="nav-main-item">--}}
                    {{--                            <a class="nav-main-link{{ request()->is('user_access') ? ' active' : '' }}" href="{{url('/user_access')}}">--}}
                    {{--                                <i class="nav-main-link-icon si si-users"></i>--}}
                    {{--                                <span class="nav-main-link-name">User Access</span>--}}
                    {{--                            </a>--}}
                    {{--                        </li>--}}
                @endif
            </ul>
        </div>
        <!-- END Side Navigation -->
    </nav>
    <!-- END Sidebar -->

    <!-- Header -->
    <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
            <!-- Left Section -->
            <div>
                <!-- Toggle Sidebar -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
                <button type="button" class="btn btn-dual mr-1" data-toggle="layout" data-action="sidebar_toggle">
                    <i class="fa fa-fw fa-bars"></i>
                </button>
                <!-- END Toggle Sidebar -->

            </div>
            <!-- END Left Section -->

            <!-- Right Section -->
            <div>
                <!-- User Dropdown -->
                <div class="dropdown d-inline-block">
                    <button type="button" class="btn btn-dual" id="page-header-user-dropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-user d-sm-none"></i>
                        <span class="d-none d-sm-inline-block">Hi, {{ Session::get('user')->first_name }}</span>
                        <i class="fa fa-fw fa-angle-down ml-1 d-none d-sm-inline-block"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right p-0" aria-labelledby="page-header-user-dropdown">
                        <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">
                            User Options
                        </div>
                        <div class="p-2">
                            <a class="dropdown-item" href="{{url('/profile')}}">
                                <i class="far fa-fw fa-user mr-1"></i> Profile
                            </a>
                            <div role="separator" class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{url('/logout')}}">
                                <i class="far fa-fw fa-arrow-alt-circle-left mr-1"></i> Sign Out
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END User Dropdown -->

                <!-- Notifications Dropdown -->
{{--                <div class="dropdown d-inline-block">--}}
{{--                    <button type="button" class="btn btn-dual" id="page-header-notifications-dropdown"--}}
{{--                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                        <i class="fa fa-fw fa-bell"></i>--}}
{{--                        <span class="badge badge-secondary badge-pill">5</span>--}}
{{--                    </button>--}}
{{--                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"--}}
{{--                         aria-labelledby="page-header-notifications-dropdown">--}}
{{--                        <div class="bg-primary-darker rounded-top font-w600 text-white text-center p-3">--}}
{{--                            Notifications--}}
{{--                        </div>--}}
{{--                        <ul class="nav-items my-2">--}}
{{--                            <li>--}}
{{--                                <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                    <div class="mx-3">--}}
{{--                                        <i class="fa fa-fw fa-check-circle text-success"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body font-size-sm pr-2">--}}
{{--                                        <div class="font-w600">App was updated to v5.6!</div>--}}
{{--                                        <div class="text-muted font-italic">3 min ago</div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                    <div class="mx-3">--}}
{{--                                        <i class="fa fa-fw fa-user-plus text-info"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body font-size-sm pr-2">--}}
{{--                                        <div class="font-w600">New Subscriber was added! You now have 2580!</div>--}}
{{--                                        <div class="text-muted font-italic">10 min ago</div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                    <div class="mx-3">--}}
{{--                                        <i class="fa fa-fw fa-times-circle text-danger"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body font-size-sm pr-2">--}}
{{--                                        <div class="font-w600">Server backup failed to complete!</div>--}}
{{--                                        <div class="text-muted font-italic">30 min ago</div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                    <div class="mx-3">--}}
{{--                                        <i class="fa fa-fw fa-exclamation-circle text-warning"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body font-size-sm pr-2">--}}
{{--                                        <div class="font-w600">You are running out of space. Please consider upgrading--}}
{{--                                            your plan.--}}
{{--                                        </div>--}}
{{--                                        <div class="text-muted font-italic">1 hour ago</div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a class="text-dark media py-2" href="javascript:void(0)">--}}
{{--                                    <div class="mx-3">--}}
{{--                                        <i class="fa fa-fw fa-plus-circle text-primary"></i>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body font-size-sm pr-2">--}}
{{--                                        <div class="font-w600">New Sale! + $30</div>--}}
{{--                                        <div class="text-muted font-italic">2 hours ago</div>--}}
{{--                                    </div>--}}
{{--                                </a>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <div class="p-2 border-top">--}}
{{--                            <a class="btn btn-light btn-block text-center" href="javascript:void(0)">--}}
{{--                                <i class="fa fa-fw fa-eye mr-1"></i> View All--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <!-- END Notifications Dropdown -->

            </div>
            <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-primary-darker">
            <div class="content-header">
                <div class="w-100 text-center">
                    <i class="fa fa-fw fa-2x fa-sun fa-spin text-white"></i>
                </div>
            </div>
        </div>
        <!-- END Header Loader -->
    </header>
    <!-- END Header -->

    <!-- Main Container -->
    <main id="main-container">
        @yield('content')
    </main>
    <!-- END Main Container -->

    <!-- Footer -->
    <footer id="page-footer" class="bg-body-light">
        <div class="content py-0">
            <div class="row font-size-sm">
                <div class="col-sm-6 order-sm-2 mb-1 mb-sm-0 text-center text-sm-right">
                    Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600"
                                                                               href="https://www.freelancer.com/u/leemilun?w=f"
                                                                               target="_blank">James</a>
                </div>
                <div class="col-sm-6 order-sm-1 text-center text-sm-left">
                    <a class="font-w600" href="{{url('/')}}" target="_blank">Pick it</a> &copy; <span
                        data-toggle="year-copy">2019</span>
                </div>
            </div>
        </div>
    </footer>
    <!-- END Footer -->
</div>
<!-- END Page Container -->

<!-- Dashmix Core JS -->
<script src="{{ mix('js/dashmix.app.js') }}"></script>

<!-- Laravel Scaffolding JS -->
<script src="{{ mix('js/laravel.app.js') }}"></script>

<script>window.baseUrl = '{{url('/')}}';</script>
@yield('js_after')
</body>
</html>
