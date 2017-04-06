@php
$packages = Laralum\Laralum\Packages::all();
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        @php
            $settings = Laralum\Settings\Models\Settings::first();
        @endphp
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title') - {{ $settings->appname }}</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        @foreach($packages as $package)
            {!! \Laralum\Laralum\Injector::inject('style', $package) !!}
        @endforeach

        @yield('css')
    </head>
    <body>

        @hasSection('title')<h1>@yield('title')</h1>@endif
        @if(Session::has('success'))
            <hr>
            <p style="color:green">
                {{Session::get('success')}}
            </p>
            <hr>
        @endif
        @if(Session::has('info'))
            <hr>
            <p style="color:blue">
                {{Session::get('info')}}
            </p>
            <hr>
        @endif
        @if(Session::has('error'))
            <hr>
            <p style="color:red">
                {{Session::get('error')}}
            </p>
            <hr>
        @endif
        @if(count($errors->all()))
            <hr>
            <p style="color:red">
                @foreach($errors->all() as $error) {{$error}}<br/>@endforeach
            </p>
            <hr>

        @endif
        @yield('content')

        <!-- jQuery first -->
        @foreach($packages as $package)
            {!! \Laralum\Laralum\Injector::inject('script', $package) !!}
        @endforeach
        @yield('js')
    </body>
</html>
