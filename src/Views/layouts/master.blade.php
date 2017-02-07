<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title') - {{ config('laralum.general.name') }}</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdn.materialdesignicons.com/1.8.36/css/materialdesignicons.min.css">
        @include('laralum::assets.css')
        {!! ConsoleTVs\Charts\Facades\Charts::assets() !!}
        @yield('css')
    </head>
    <body>

        <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand" href="#">{{ config('laralum.general.name') }}</a>
                    <ul class="navbar-nav mr-auto">
                        @foreach(Laralum\Laralum\Packages::all() as $package)
                            @php $items = Laralum\Laralum\Packages::menu($package); @endphp
                            @if($items)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="{{ $package }}-menu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ ucfirst($package) }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="{{ $package }}-menu">
                                        @foreach($items as $item)
                                            @if( array_key_exists('text', $item) and array_key_exists('link', $item) )
                                                <a class="dropdown-item" href="{{ $item['link'] }}">{{ $item['text'] }}</a>
                                            @elseif( array_key_exists('text', $item) and array_key_exists('route', $item) )
                                                <a class="dropdown-item" href="{{ route($item['route']) }}">{{ $item['text'] }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
        <div class="jumbotron jumbotron-fluid">
            <div class="container">
                <h1 class="display-3"><span class="mdi @yield('icon')"></span> @yield('title')</h1>
                <p class="lead">@yield('subtitle')</p>
            </div>
        </div>

        <div class="container">
            @yield('content')
        </div>

        <!-- jQuery first, then Tether, then Bootstrap JS. -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
        @yield('js')
    </body>
</html>
