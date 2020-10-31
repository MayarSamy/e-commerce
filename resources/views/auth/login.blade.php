@extends('layouts.auth')

@section('content')

<div class="container-login100" style="background-image: url('/website-style/images/all-bg-title.jpg');">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- <div class="card"> --}}
                    {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                <div class="card-body">
                    <body class="hold-transition login-page">
                        <div class="login-box">
                            <!-- /.login-logo -->
                            <div class="card">
                                <div class="card-body login-card-body">
                                    <p class="login-box-msg">Sign in</p>
                            
                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="input-group mb-3">
                                            <input type="email" class="form-control" placeholder="Email" name="email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="password" class="form-control" placeholder="Password" name="password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-8">
                                        <div class="icheck-primary">
                                            <input type="checkbox" id="remember">
                                            <label for="remember">
                                            Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                    </div>
                                    <!-- /.col -->
                                    </div>
                                </form>
                            
                                <div class="social-auth-links text-center mb-3">
                                    <p>- OR -</p>
                                    <a href="#" class="btn btn-block btn-primary">
                                    <i class="fa fa-facebook-f mr-2"></i> Sign in using Facebook
                                    </a>
                                    <a href="#" class="btn btn-block btn-danger">
                                    <i class="/login-style/images/icons/icon-google.png mr-2"></i> Sign in using Google+
                                    </a>
                                </div>
                                <!-- /.social-auth-links -->
                            
                                <p class="mb-1">
                                    <a href="forgot-password.html">I forgot my password</a>
                                </p>
                                <p class="mb-0">
                                    <a href="register" class="text-center">Register a new membership</a>
                                </p>
                                </div>
                                <!-- /.login-card-body -->
                            </div>
                            </div>
                            <!-- /.login-box -->
                        
                        {{-- <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="input-group mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

