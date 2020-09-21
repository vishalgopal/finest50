@extends('layout.main')

@section('content')

<section id="content" class="loginpage">
    <div class="content-wrap">
        <div class="container-fluid" style="max-width: 850px;">

            <div class="row">

                <div class="col-lg-5 login-right card">
                    <img src="{{ asset('images/login2.svg') }}" alt="Login">
                    <h3>Welcome to Finest 50</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum dolor sit amet.</p>

                </div>

                <div class="col-12 col-lg-7 mb-0 login-left">
                    <div class="card mb-0">
                        <div class="card-body" style="padding: 40px;">
                            <form id="login-form" method="POST" action="{{ route('login') }}"
                                name="login-form" class="mb-0" action="#" method="post">
                                @csrf
                                <h3>{{ __('Login') }} to your Account</h3>

                                <div class="row">
                                    <div class="col-12 form-group">
                                        <label
                                            for="login-form-username">{{ __('E-Mail Address') }}:</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="login-form-password">{{ __('Password') }}:</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-12 form-group float-right">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>

                                    <div class="col-12 form-group">
                                        <button class="button button-3d button-primary m-0" id="login-form-submit"
                                            name="login-form-submit" type="submit"
                                            value="login">{{ __('Login') }}</button>
                                        @if(Route::has('password.request'))
                                            <a class="btn btn-link"
                                                href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>

                                    <div class="divider my-3 divider-rounded divider-center">&nbsp;&nbsp;or&nbsp;&nbsp;
                                    </div>

                                    <div class="login-btns form-group">
                                        <a href="{{ route('social.oauth', 'google') }}" class="btn btn-outline-dark"><img
                                                src="{{ asset('images/login/gmail.svg') }}">Log
                                            in with Google</a>

                                        <a href="{{ route('social.oauth', 'facebook') }}" class="btn btn-outline-dark"><img
                                                src="{{ asset('images/login/facebook.svg') }}">Log
                                            in with Facebook</a>

                                    </div>
                                    <div class="login-btns form-group">
                                        <a href="{{ route('social.oauth', 'linkedin') }}" class="btn btn-outline-dark"><img
                                                src="{{ asset('images/login/linkedin.svg') }}">Log
                                            in with LinkedIn</a>

                                        <a href="{{ route('social.oauth', 'twitter') }}" class="btn btn-outline-dark"><img
                                                src="{{ asset('images/login/twitter.svg') }}">Log
                                            in with Twitter</a>

                                    </div>

                                    <div class="divider my-3"></div>

                                    <div class="col-12 form-group">
                                        New to Finest 50? <a href="{{ route('register') }}"
                                            onclick="">Create account</a>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>


                </div>

            </div>
            <!-- row end -->

        </div>
    </div>
</section><!-- #content end -->
@endsection
