@extends('laralum::layouts.master')
@section('icon', 'ion-alert-circled')
@section('title', trans('laralum::general.confirmation_page'))
@section('subtitle', trans('laralum::general.perform_action'))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('laralum::index') }}">@lang('laralum::general.home')</a></li>
        <li><span href="">@lang('laralum::general.confirmation_page')</span></li>
    </ul>
@endsection
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('laralum::general.confirmation_page')
                    </div>
                    <div class="uk-card-body">

                            <h4>@if(isset($message)) {{ $message }} @else @lang('laralum::general.confirmation_proceed') @endif</h4>
                            <p>@lang('laralum::general.confirmation_info')</p>
                            <br>
                        <form class="uk-form-stacked"  @if(isset($action)) action="{{ $action }}" @endif method="POST">
                            {{ csrf_field() }}
                            @if(isset($method)) {{ method_field($method) }} @endif
                                <div class="uk-margin">
                                    <a href="{{ URL::previous() }}" class="uk-button uk-button-default uk-align-left">@lang('laralum::general.take_me_back')</a>
                                    <button type="submit" class="uk-button uk-button-primary uk-align-right">
                                        <span class="ion-forward"></span>&nbsp; @if(isset($button)) {{ $button }} @else @lang('laralum::general.proceed') @endif
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
        </div>
    </div>
@endsection
