@extends('laralum::layouts.master')
@section('icon', 'mdi-exclamation')
@section('title', 'Confirmation Page')
@section('subtitle', 'Are you sure you want to perform this action ?')
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3">
            <div class="card shadow">
                <div class="card-block">
                    <form @if(isset($action)) action="{{ $action }}" @endif method="POST">
                        {{ csrf_field() }}
                        @if(isset($method))
                            {{ method_field($method) }}
                        @endif
                        <h4>Are you sure?</h4>
                        <p>This action cannot be undone.</p>
                        <a href="{{ URL::previous() }}" class="btn btn-info float-left">Take me back</a>
                        <button type="submit" class="btn btn-danger float-right clickable">Yes, go on!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
