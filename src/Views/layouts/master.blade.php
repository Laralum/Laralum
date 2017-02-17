<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.0-alpha.3
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">

<head>
    @php $packages = Laralum\Laralum\Packages::all(); @endphp

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{{ Laralum\Settings\Models\Settings::first()->appname }} - @yield('title')">
    <meta name="author" content="{{ Laralum\Settings\Models\Settings::first()->appname }}">
    <meta name="keyword" content="Laralum,Bootstrap,Admin,Template,Open,Source,AngularJS,Angular,Angular2,jQuery,CSS,HTML,RWD,Dashboard">
    <link rel="shortcut icon" href="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/laralum.ico">

    <title>@yield('title') - {{ Laralum\Settings\Models\Settings::first()->appname }}</title>

    <!-- Icons -->
    <link href="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/css/simple-line-icons.css" rel="stylesheet">

    <!-- Main styles for this application -->
    <link href="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/css/style.css" rel="stylesheet">

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/1.8.36/css/materialdesignicons.min.css">

    <!-- Sweetalert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.css">

    <!-- CSS Injection for packages -->
    @foreach($packages as $package)
        {!! Laralum\Laralum\Injector::inject('style', $package) !!}
    @endforeach

    @include('laralum::assets.css')
    @yield('css')

    <!-- Charts Assets -->
    {!! ConsoleTVs\Charts\Facades\Charts::assets() !!}

</head>

<!-- BODY options, add following classes to body to change options

// Header options
1. '.header-fixed'					- Fixed Header

// Sidebar options
1. '.sidebar-fixed'					- Fixed Sidebar
2. '.sidebar-hidden'				- Hidden Sidebar
3. '.sidebar-off-canvas'		- Off Canvas Sidebar
4. '.sidebar-compact'				- Compact Sidebar Navigation (Only icons)

// Aside options
1. '.aside-menu-fixed'			- Fixed Aside Menu
2. '.aside-menu-hidden'			- Hidden Aside Menu
3. '.aside-menu-off-canvas'	- Off Canvas Aside Menu

// Footer options
1. '.footer-fixed'						- Fixed footer

-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler hidden-lg-up" type="button">☰</button>
        <a class="navbar-brand" href="{{ route('laralum::index') }}"></a>
        <ul class="nav navbar-nav hidden-md-down">
            <li class="nav-item">
                <a class="nav-link navbar-toggler sidebar-toggler" href="#">☰</a>
            </li>
        </ul>
        <ul class="nav navbar-nav ml-auto">
            <li class="nav-item dropdown" style="padding-right: 15px;">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="hidden-md-down">{{ Auth::user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#"><i class="fa fa-lock"></i> Logout</a>
                </div>
            </li>

        </ul>
    </header>

    <div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">
                        Official Modules
                    </li>
                    @foreach($packages as $package)
                        @php $menu = Laralum\Laralum\Packages::menu($package); @endphp
                        @if( $menu and array_key_exists('items', $menu) )
                            <li class="nav-item nav-dropdown">
                                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-star"></i> {{ array_key_exists('name', $menu) ? $menu['name'] : ucfirst($package) }}</a>
                                <ul class="nav-dropdown-items">
                                    @foreach($menu['items'] as $item)
                                        <li class="nav-item">
                                            @if( array_key_exists('text', $item) and array_key_exists('link', $item) )
                                                <a class="nav-link" href="{{ $item['link'] }}"><i class="icon-star"></i> {{ $item['text'] }}</a>
                                            @elseif( array_key_exists('text', $item) and array_key_exists('route', $item) )
                                                <a class="nav-link" href="{{ route($item['route']) }}"><i class="icon-star"></i> {{ $item['text'] }}</a>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @elseif( $menu and array_key_exists('item', $menu) )
                            @if( array_key_exists('text', $menu['item']) and array_key_exists('link', $menu['item']) )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ $menu['item']['link'] }}"><i class="icon-star"></i> {{ $menu['item']['text'] }}</a>
                                </li>
                            @elseif( array_key_exists('text', $menu['item']) and array_key_exists('route', $menu['item']) )
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route($menu['item']['route']) }}"><i class="icon-star"></i> {{ $menu['item']['text'] }}</a>
                                </li>
                            @endif
                        @endif
                    @endforeach


                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <main class="main">

            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</li>
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>


            <div class="container-fluid">
                <div class="animated fadeIn">
                    @yield('content')
                </div>

            </div>
            <!-- /.conainer-fluid -->
        </main>


    </div>

    <footer class="app-footer">
        <a href="{{ url('/') }}">{{ Laralum\Settings\Models\Settings::first()->appname }}</a> © 2017 Company.
        <span class="float-right">Powered by <a href="http://github.com/Laralum/Laralum">Laralum</a>
        </span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/bower_components/pace/pace.min.js"></script>


    <!-- Plugins and scripts required by all views -->
    <script src="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/bower_components/chart.js/dist/Chart.min.js"></script>


    <!-- GenesisUI main scripts -->

    <script src="https://cdn.rawgit.com/Laralum/Laralum/master/src/Assets/js/app.js"></script>
    @include('laralum::assets.js')
    @yield('js')

    <!-- JS Injection for packages -->
    @foreach($packages as $package)
        {!! Laralum\Laralum\Injector::inject('script', $package) !!}
    @endforeach

</body>

</html>
