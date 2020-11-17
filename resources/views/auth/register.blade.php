@extends('layout.main')

@section('content')
<section id="content" class="loginpage">
    <div class="content-wrap">
        <div class="container-fluid" style="max-width: 850px;">

            <div class="row">

                <div class="col-lg-5 login-right card">
                    <img src="images/login2.svg" alt="Login">
                    <h3>Welcome to Finest 50</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit ipsum dolor sit amet.</p>

                </div>

                <div class="col-12 col-lg-7 mb-0 login-left">
                    <div class="card mb-0">
                        <div class="card-body" style="padding: 40px;">
                            <h3>{{ __('Register') }}</h3>

                            <form id="register-form" name="register-form" class="row mb-0" method="POST"
                                action="{{ route('register') }}">
                                @csrf
                                <div class="col-12 form-group">
                                    <label for="name"
                                        class="">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name"
                                        autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 form-group">
                                    <label for="email"
                                        class="">{{ __('E-Mail Address') }}</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 form-group">
                                    <label for="password"
                                        class="">{{ __('Password') }}</label>

                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 form-group">
                                    <label for="password-confirm"
                                        class="">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password">
                                </div>

                                <div class="col-12 form-group">
                                    <button class="button button-3d button-primary m-0" id="register-form-submit"
                                        name="register-form-submit" value="register" type="submit">{{ __('Register') }}</button>
                                </div>

                                <div class="divider my-3 divider-rounded divider-center">&nbsp;&nbsp;or&nbsp;&nbsp;</div>

                                <h4 class="mb-0">

                                    Already have an account? <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                </h4>

                            </form>
                        </div>
                    </div>


                </div>

            </div>
            <!-- row end -->

        </div>
    </div>
</section><!-- #content end -->
<!-- Ends -->

@endsection


<!-- register  -->
