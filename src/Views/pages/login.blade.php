@extends('laralum::layouts.public')
@section('title', 'Login')
@section('css')
    <style>
        body {
            background: #EEEEEE;
        }
        .login-margin {
            margin-top: 200px;
        }
    </style>
@endsection
@section('content')
<div class="login-margin">
    <div class="row">
        <div class="col-md-12 col-lg-6 offset-lg-3">
            <div class="card shadow">
                <div class="card-block">
                    <center>
                        <h1>{{ config('laralum.general.name') }}</h1>
                        <p>Please login to continue</p>
                    </center>
                    <br />
                    <form method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary clickable">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
