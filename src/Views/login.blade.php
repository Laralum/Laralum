@extends('laralum::basicLayout')
@section('background-color', '#EEEEEE')
@section('title', 'Login')
@section('top')
<script src="{{ asset('/vendor/laralum/js/jquery.particleground.min.js') }}"></script>
<style>
    .particles{
        position: absolute;
        width: 100%;
        height: 100%;
    }
    .top{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index:99;
        margin-top: 200px;
    }
</style>
@endsection
@section('content')
<div class="particles" style="background-color: #1678c2 ;"></div>
    <div class="top">
        <div class="ui container">
            <div class="ui stackable grid">
                <div class="four wide column"></div>
                <div class="eight wide column">
                    <div class="ui very padded piled segment">
                      <center>
                          <div style="padding-left: 75px; padding-right: 75px;">
                              <img class="ui fluid image" src="{{ asset('vendor/laralum/images/logo-text.png') }}">
                          </div>
                        </center>
                        <br><br>
                        <form class="ui form" method="POST">
                            {{ csrf_field() }}
                            <div class="field">
                                <label>{{ trans('laralum::general.email') }}</label>
                                <input autofocus value="{{ old('email') }}" type="text" name="email" placeholder="{{ trans('laralum::general.email') }}">
                            </div>
                            <div class="field">
                                <label>{{ trans('laralum::general.password') }}</label>
                                <input type="password" name="password" placeholder="{{ trans('laralum::general.password') }}">
                            </div>
                            <div class="field">
                                <div class="ui checkbox">
                                    <input type="checkbox" tabindex="0" class="hidden" name="remember">
                                    <label>{{ trans('laralum::general.remember_me') }}</label>
                                </div>
                            </div>
                            <br>
                            <button class="ui button" type="submit">{{ trans('laralum::general.submit') }}</button>
                        </form>
                    </div>
                </div>
                <div class="four wide column"></div>
            </div>
        </div>
    </div>
@endsection
@section('bot')
<script>
    $('.particles').particleground({
        dotColor: '#ffffff',
        lineColor: '#ffffff',
        parallax: false,
    });
    $('.ui.checkbox').checkbox();
</script>
@endsection
