@php
    $settings = \Laralum\Settings\Models\Settings::first();
    $packages = \Laralum\Laralum\Packages::all();
@endphp
<!DOCTYPE html>
<html>
    <head>
        <title>@lang('laralum::general.login') - {{ $settings->appname }}</title>

        <meta charset="UTF-8">
        <meta name="description" content="Clean and responsive administration panel">
        <meta name="keywords" content="Admin,Panel,HTML,CSS,XML,JavaScript">
        <meta name="author" content="Erik Campobadal">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdn.rawgit.com/Laralum/Laralum/0d0e7bbe/src/Assets/css/uikit.min.css" />
        <link rel="stylesheet" href="https://cdn.rawgit.com/Laralum/Laralum/0d0e7bbe/src/Assets/css/style.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/Laralum/Laralum/0d0e7bbe/src/Assets/js/uikit.min.js" ></script>
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="https://cdn.rawgit.com/Laralum/Laralum/95d11fe4/src/Assets/css/notyf.min.css" />

        @include('laralum::assets.css')

        @foreach($packages as $package)
            {!! \Laralum\Laralum\Injector::inject('style', $package) !!}
        @endforeach
    </head>
    <body>
        <div uk-sticky="media: 960" class="uk-navbar-container tm-navbar-container uk-sticky uk-active" style="position: fixed; top: 0px; width: 1903px;">
            <div class="uk-container uk-container-expand">
                <nav uk-navbar>
                    <div class="uk-navbar-left">
                        <a href="#" class="uk-navbar-item uk-logo">
                            {{ $settings->appname }}
                        </a>
                    </div>
                </nav>
            </div>
        </div>
        <div class="content-background">
            <div class="uk-section-large">
                <div class="uk-container uk-container-large">
                    <div uk-grid class="uk-child-width-1-1@s uk-child-width-2-3@l">
                        <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
                        <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                            <div class="uk-card uk-card-default">
                                <div class="uk-card-header">
                                    @lang("laralum::general.login_page")
                                </div>
                                <div class="uk-card-body">
                                    <center>
                                        <h2>{{ $settings->appname }}</h2><br />
                                    </center>
                                    <form method="POST" action="{{ route('laralum::login_post') }}" class="uk-form-stacked">
                                        {{ csrf_field() }}
                                        <fieldset class="uk-fieldset">

                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-android-person"></span>
                                                    <input value="{{ old('email') }}" name="email" class="uk-input" type="text" placeholder="{{ __("laralum::general.email") }}">
                                                </div>
                                            </div>

                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <span class="uk-form-icon ion-locked"></span>
                                                    <input name="password" class="uk-input" type="password" placeholder="{{ __("laralum::general.password") }}">
                                                </div>
                                            </div>

                                            <div class="uk-margin">
                                                <div class="uk-position-relative">
                                                    <label><input name="remember" {{ !old('remember') ?: 'checked' }} class="uk-checkbox" type="checkbox">@lang('laralum::general.remember_me')</label><br />
                                                </div>
                                            </div>

                                            <div class="uk-margin">
                                                <a href="#">@lang("laralum::general.forgot_password")</a>
                                            </div>

                                            <div class="uk-margin">
                                                <button type="submit" class="uk-button uk-button-primary">
                                                    <span class="ion-forward"></span>&nbsp; @lang('laralum::general.login')
                                                </button>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js" integrity="sha256-GcknncGKzlKm69d+sp+k3A2NyQE+jnu43aBl6rrDN2I=" crossorigin="anonymous"></script>
        <script src="https://cdn.rawgit.com/Laralum/Laralum/95d11fe4/src/Assets/js/notyf.min.js"></script>
        <script src="https://cdn.rawgit.com/Laralum/Laralum/0d0e7bbe/src/Assets/js/script.js"></script>

        @include('laralum::assets.js')

        @foreach($packages as $package)
            {!! \Laralum\Laralum\Injector::inject('script', $package) !!}
        @endforeach
    </body>
</html>
