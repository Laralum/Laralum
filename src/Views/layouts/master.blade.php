@php
$settings = \Laralum\Settings\Models\Settings::first();
$packages = \Laralum\Laralum\Packages::all();
@endphp
<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') - {{ $settings->appname }}</title>

        <meta charset="UTF-8">
        <meta name="description" content="The modular laravel administration panel">
        <meta name="keywords" content="Laralum,Admin,Panel,CMS,Laravel,Modern,Developers">
        <meta name="author" content="Erik Campobadal, Aitor Riba">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/css/uikit.min.css" integrity="sha256-k8IzyP/qSivihqS5ogICYMqmuacc6Op6HQrFMGRrdfw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdn.rawgit.com/Laralum/Laralum/95d11fe4/src/Assets/css/style.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js" integrity="sha256-zg8+ewp+R2ncGBMQ3a+rhfLlef0gxfkG9zrBf+oSTQU=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit-icons.min.js" integrity="sha256-iC7144xSYml8vsBsLNUxTvd3NAXNgnZrhv7ineC3t/o=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.rawgit.com/Laralum/Laralum/95d11fe4/src/Assets/css/notyf.min.css" />

        <!-- CSS Injection for packages -->
        @foreach ($packages as $package)
            {!! \Laralum\Laralum\Injector::inject('style', $package) !!}
        @endforeach

        @include('laralum::assets.css')

        @yield('css')

        <!-- Charts Assets -->
        {!! ConsoleTVs\Charts\Facades\Charts::assets() !!}
    </head>
    <body>
        <div uk-sticky class="uk-navbar-container tm-navbar-container uk-active">
            <div class="uk-container uk-container-expand">
                <nav class="uk-navbar-container" uk-navbar>
                    <div class="uk-navbar-left">
                        <a id="sidebar_toggle" class="uk-navbar-toggle" uk-navbar-toggle-icon href="#"></a>
                        <a href="{{ route('laralum::index') }}" class="uk-navbar-item uk-logo">
                            {{ $settings->appname }}
                        </a>
                    </div>
                    <div class="uk-navbar-right uk-light">
                        <ul class="uk-navbar-nav">
                            <li class="uk-active">
                                <a id="navbar_name" href="#">{{ Auth::user()->name }} &nbsp;<span class="ion-ios-arrow-down"></span></a>
                                <div uk-dropdown="pos: bottom-right; mode: click; offset: -17;">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <!-- User Injector -->
                                        @foreach ($packages as $package)
                                            @php $items = \Laralum\Laralum\Injector::inject('user', $package) @endphp
                                            @if ($items)
                                                @php
                                                $counter = 0;
                                                    foreach ($items as $item) {
                                                        $counter = $counter + (isset($item['counter']) ? $item['counter'] : 0);
                                                    }
                                                @endphp
                                                <li class="uk-nav-header">{{ $package }} @if($counter) <span class="uk-badge">{{$counter}}</span> @endif
                                                </li>
                                                @foreach ($items as $item)
                                                    <li>
                                                        <a href="{{ $item['url'] }}">
                                                            {{ $item['text'] }}
                                                            @php
                                                            $show = isset($item['counter']) ? $item['counter'] : false;
                                                            @endphp
                                                            @if ($show) <span class="uk-badge">{{$show}}</span> @endif
                                                        </a>

                                                    </li>
                                                @endforeach
                                            @endif
                                        @endforeach
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
                    <img id="avatar" style="max-width:100px;max-height:100px;" class="uk-border-circle" src="{{ Laralum\Users\Models\User::findOrFail(Auth::id())->avatar() }}" />
                    <div class="uk-margin-top"></div>
                    <div id="name" class="uk-text-truncate">{{ Auth::user()->name }}</div>
                    <div id="email" class="uk-text-truncate">{{ Auth::user()->email }}</div>
                    <span id="status" data-enabled="true" data-online-text="{{ __('laralum::general.online') }}" data-away-text="{{ __('laralum::general.away') }}" data-interval="20000" class="uk-margin-top uk-label uk-label-success"></span>
                </div>
                <br />
            </center>
            <ul class="uk-nav uk-nav-default">
                @foreach ($packages as $package)
                    @php $menu = Laralum\Laralum\Packages::menu($package); @endphp
                    @if ($menu and array_key_exists('items', $menu) )
                        <li class="uk-nav-header">
                            {{ ucfirst($package) }}
                        </li>
                        @foreach ($menu['items'] as $item)
                            <li>
                                @if ((array_key_exists('text', $item) or array_key_exists('trans', $item)) and array_key_exists('link', $item))
                                    <a href="{{ $item['link'] }}">
                                        {{ array_key_exists('trans', $item) ? __($item['trans']) : $item['text'] }}
                                    </a>
                                @elseif ((array_key_exists('text', $item) or array_key_exists('trans', $item)) and array_key_exists('route', $item))
                                    <a href="{{ route($item['route']) }}">
                                        {{ array_key_exists('trans', $item) ? __($item['trans']) : $item['text'] }}
                                    </a>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.transit/0.9.12/jquery.transit.min.js" integrity="sha256-rqEXy4JTnKZom8mLVQpvni3QHbynfjPmPxQVsPZgmJY=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/Laralum/Laralum/95d11fe4/src/Assets/js/script.js"></script>
        <script src="https://cdn.rawgit.com/Laralum/Laralum/95d11fe4/src/Assets/js/status.js"></script>
        <script src="https://cdn.rawgit.com/Laralum/Laralum/95d11fe4/src/Assets/js/notyf.min.js"></script>

        @include('laralum::assets.js')

        @yield('js')

        <!-- JS Injection for packages -->
        @foreach ($packages as $package)
            {!! \Laralum\Laralum\Injector::inject('script', $package) !!}
        @endforeach
    </body>
</html>
