@php
$settings = Laralum\Settings\Models\Settings::first();
$packages = Laralum\Laralum\Packages::all();
@endphp
<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') - {{ $settings->appname }}</title>

        <meta charset="UTF-8">
        <meta name="description" content="Clean and responsive administration panel">
        <meta name="keywords" content="Admin,Panel,HTML,CSS,XML,JavaScript">
        <meta name="author" content="Erik Campobadal">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdn.rawgit.com/Laralum/Laralum/7aea0ec0/src/Assets/css/uikit.min.css" />
        <link rel="stylesheet" href="https://cdn.rawgit.com/Laralum/Laralum/7aea0ec0/src/Assets/css/style.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/Laralum/Laralum/7aea0ec0/src/Assets/js/uikit.min.js" ></script>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

        <!-- CSS Injection for packages -->
        @foreach($packages as $package)
            {!! Laralum\Laralum\Injector::inject('style', $package) !!}
        @endforeach

        @include('laralum::assets.css')

        @yield('css')

        <!-- Charts Assets -->
        {!! ConsoleTVs\Charts\Facades\Charts::assets() !!}
    </head>
    <body>
        <div uk-sticky class="uk-navbar-container tm-navbar-container uk-active">
            <div class="uk-container uk-container-expand">
                <nav uk-navbar="mode: click; offset: -17;">
                    <div class="uk-navbar-left">
                        <a id="sidebar_toggle" class="uk-navbar-toggle" uk-navbar-toggle-icon href="#"></a>
                        <a href="{{ route('laralum::index') }}" class="uk-navbar-item uk-logo">
                            {{ $settings->appname }}
                        </a>
                    </div>
                    <div class="uk-navbar-right uk-light">
                        <ul class="uk-navbar-nav">
                            <li class="uk-active">
                                <a href="#">{{ Auth::user()->name }} &nbsp;<span class="ion-ios-arrow-down"></span></a>
                                <div class="uk-navbar-dropdown">
                                   <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <li class="uk-nav-header">Actions</li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                   </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div id="sidebar" class="tm-sidebar-left uk-background">
            <center>
                <div class="user">
                    <img id="avatar" width="100" class="uk-border-circle" src="https://cdn.rawgit.com/Laralum/Laralum/0d0e7bbe/src/Assets/images/avatar.jpg" />
                    <div class="uk-margin-top"></div>
                    <div id="name" class="uk-text-break">{{ Auth::user()->name }}</div>
                    <div id="email" class="uk-text-break">{{ Auth::user()->email }}</div>
                    <span id="status" data-enabled="true" data-online-text="{{ __('laralum::general.online') }}" data-away-text="{{ __('laralum::general.away') }}" data-interval="20000" class="uk-margin-top uk-label uk-label-success"></span>
                </div>
                <br />
            </center>
            <ul class="uk-nav uk-nav-default">
                @foreach($packages as $package)
                    @php $menu = Laralum\Laralum\Packages::menu($package); @endphp
                    @if( $menu and array_key_exists('items', $menu) )
                        <li class="uk-nav-header">
                            {{ ucfirst($package) }}
                        </li>
                        @foreach($menu['items'] as $item)
                            <li>
                                @if( array_key_exists('text', $item) and array_key_exists('link', $item) )
                                    <a href="{{ $item['link'] }}">{{ $item['text'] }}</a>
                                @elseif( array_key_exists('text', $item) and array_key_exists('route', $item) )
                                    <a href="{{ route($item['route']) }}">{{ $item['text'] }}</a>
                                @endif
                            </li>
                        @endforeach
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="content-padder content-background">
            <div class="uk-section-small uk-section-default header">
                <div class="uk-container uk-container-large">
                    <h1><span class="@yield('icon')"></span> @yield('title')</h1>
                    <p>
                        @yield('subtitle')
                    </p>
                    @yield('breadcrumb')
                </div>
            </div>
            <div class="uk-section-small">
                @yield('content')
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js" integrity="sha256-GcknncGKzlKm69d+sp+k3A2NyQE+jnu43aBl6rrDN2I=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.12/jquery.transit.min.js" integrity="sha256-rqEXy4JTnKZom8mLVQpvni3QHbynfjPmPxQVsPZgmJY=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/Laralum/Laralum/7aea0ec0/src/Assets/js/script.js"></script>
        <script src="https://cdn.rawgit.com/Laralum/Laralum/7aea0ec0/src/Assets/js/status.js"></script>

        @include('laralum::assets.js')
        @yield('js')

        <!-- JS Injection for packages -->
        @foreach($packages as $package)
            {!! Laralum\Laralum\Injector::inject('script', $package) !!}
        @endforeach
    </body>
</html>
