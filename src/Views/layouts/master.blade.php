@php
    $settings = \Laralum\Settings\Models\Settings::first();
    $packages = \Laralum\Laralum\Packages::all();
    $user = \Laralum\Users\Models\User::findOrFail(Auth::id());
@endphp
<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title') - {{ $settings->appname }}</title>

        <meta charset="UTF-8">
        <meta name="description" content="{{ $settings->description }}">
        <meta name="keywords" content="{{ $settings->keywords }}">
        <meta name="author" content="{{ $settings->author }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/css/uikit.min.css" integrity="sha256-k8IzyP/qSivihqS5ogICYMqmuacc6Op6HQrFMGRrdfw=" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://gitcdn.xyz/cdn/Laralum/Laralum/feecc1c067d7fb9dd7e16b8524b591eae28455a3/src/Assets/css/style.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit.min.js" integrity="sha256-zg8+ewp+R2ncGBMQ3a+rhfLlef0gxfkG9zrBf+oSTQU=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.20/js/uikit-icons.min.js" integrity="sha256-iC7144xSYml8vsBsLNUxTvd3NAXNgnZrhv7ineC3t/o=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://gitcdn.xyz/cdn/Laralum/Laralum/feecc1c067d7fb9dd7e16b8524b591eae28455a3/src/Assets/css/notyf.min.css" />

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
                        <a href="{{ route('laralum::index') }}" class="uk-navbar-item uk-logo">{{ $settings->appname }}</a>
                    </div>
                    <div class="uk-navbar-right uk-light">
                        <ul class="uk-navbar-nav">
                            <li class="uk-active">
                                <a id="navbar_lang" href="#"><span style="font-size:25px" class="ion-earth"></span></a>
                                <div sty uk-dropdown="pos: bottom-center; mode: click; offset: -17;">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">
                                        <!-- User Injector -->
                                        <li class="uk-nav-header">Select Language</li>
                                        @foreach (config('laralum.languages') as $lang)
                                            @if (in_array($lang, config('localizer.allowed_langs')) && $lang != \Aitor24\Localizer\Facades\LocalizerFacade::getCurrentCode())
                                                <li>
                                                    <a href="{{ route("localizer::setLocale", ['lang' => $lang]) }}">
                                                        {{ \Aitor24\Localizer\Facades\LocalizerFacade::getLanguage($lang) }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
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
                                                <li class="uk-nav-header">{{ $package }} @if($counter) <span class="uk-badge">{{ $counter }}</span> @endif
                                                </li>
                                                @foreach ($items as $item)
                                                    <li>
                                                        <a href="{{ $item['url'] }}">
                                                            {{ $item['text'] }}
                                                            @php
                                                                $show = isset($item['counter']) ? $item['counter'] : false;
                                                            @endphp
                                                            @if ($show) <span class="uk-badge">{{ $show }}</span> @endif
                                                        </a>

                                                    </li>
                                                @endforeach
                                            @endif
                                        @endforeach
                                        <li class="uk-nav-header">@lang('laralum::general.actions')</li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                @lang('laralum::general.logout')
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
        <div id="sidebar" class="tm-sidebar-left uk-background-default">
            <center>
                <div class="user">
                    <img id="avatar" style="max-width:100px;max-height:100px;" class="uk-border-circle" src="{{ $user->avatar() }}" />
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
                        @php
                            $generalPerm = false;
                            foreach ($menu['items'] as $item) {
                                if (! array_key_exists('permission', $item)) {
                                    $generalPerm = true;
                                } else {
                                    (! ($user->hasPermission($item['permission']) || $user->superAdmin())) ?: $generalPerm = true;
                                }
                            }
                        @endphp
                        @if($generalPerm)
                            <li class="uk-nav-header">
                                {{ ucfirst($package) }}
                            </li>
                        @endif
                        @foreach ($menu['items'] as $item)
                            @if (array_key_exists('permission', $item))
                                @if ($user->hasPermission($item['permission']) || $user->superAdmin())
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
                                @endif
                            @else
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
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if (array_key_exists('menu', config('laralum')))
                    @foreach (config('laralum.menu') as $custom_menu)
                        <li class="uk-nav-header">
                            {{ $custom_menu['title'] }}
                        </li>
                        @foreach ($custom_menu['items'] as $custom_item)
                            @if (array_key_exists('text', $custom_item) or array_key_exists('trans', $custom_item))
                                @if (array_key_exists('permission', $custom_item))
                                    @if ($user->hasPermission($custom_item['permission']) || $user->superAdmin())
                                        <li>
                                            @if ((array_key_exists('text', $custom_item) or array_key_exists('trans', $custom_item)) and array_key_exists('link', $custom_item))
                                                <a href="{{ $custom_item['link'] }}">
                                                    {{ array_key_exists('trans', $custom_item) ? __($custom_item['trans']) : $custom_item['text'] }}
                                                </a>
                                            @elseif ((array_key_exists('text', $custom_item) or array_key_exists('trans', $custom_item)) and array_key_exists('route', $custom_item))
                                                <a href="{{ route($custom_item['route']) }}">
                                                    {{ array_key_exists('trans', $custom_item) ? __($custom_item['trans']) : $custom_item['text'] }}
                                                </a>
                                            @endif
                                        </li>
                                    @endif
                                @else
                                    <li>
                                        @if ((array_key_exists('text', $custom_item) or array_key_exists('trans', $custom_item)) and array_key_exists('link', $custom_item))
                                            <a href="{{ $custom_item['link'] }}">
                                                {{ array_key_exists('trans', $custom_item) ? __($custom_item['trans']) : $custom_item['text'] }}
                                            </a>
                                        @elseif ((array_key_exists('text', $custom_item) or array_key_exists('trans', $custom_item)) and array_key_exists('route', $custom_item))
                                            <a href="{{ route($custom_item['route']) }}">
                                                {{ array_key_exists('trans', $custom_item) ? __($custom_item['trans']) : $custom_item['text'] }}
                                            </a>
                                        @endif
                                    </li>
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                @endif
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
        <script src="https://gitcdn.xyz/cdn/Laralum/Laralum/feecc1c067d7fb9dd7e16b8524b591eae28455a3/src/Assets/js/script.js"></script>
        <script src="https://gitcdn.xyz/cdn/Laralum/Laralum/feecc1c067d7fb9dd7e16b8524b591eae28455a3/src/Assets/js/status.js"></script>
        <script src="https://gitcdn.xyz/cdn/Laralum/Laralum/feecc1c067d7fb9dd7e16b8524b591eae28455a3/src/Assets/js/notyf.min.js"></script>

        @include('laralum::assets.js')

        @yield('js')

        <!-- JS Injection for packages -->
        @foreach ($packages as $package)
            {!! \Laralum\Laralum\Injector::inject('script', $package) !!}
        @endforeach

        <script>
            $(function() {
                function resize_navbar()
                {
                    if ($( window ).width() < 960) {
                        $('#navbar_name').html("<span style='font-size:25px' class='ion-person'></span>");
                    } else {
                        $('#navbar_name').html("{{ Auth::user()->name }}");
                    }
                }
                resize_navbar();
                $( window ).resize(function() {
            		resize_navbar();
            	});
            })
        </script>
    </body>
</html>
