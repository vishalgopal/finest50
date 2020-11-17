@extends('layout.main')

@section('content')
@if (\Auth::check())
    <script>window.location = "{{ URL::to('/') }}";</script>
@endif

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
                            <h3>{{ __('Login') }}</h3>

                            <form id="login-form" name="login-form" class="row mb-0" method="POST"
                            onsubmit="return registerpage();">
                                @csrf
                                <div class="col-12 form-group">
                                    <label for="email"
                                        class="">{{ __('E-Mail Address') }}</label>

                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email" data-parsley-type="email" data-parsley-trigger="change">
                                        <span id="email_error"></span> 
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="divider my-3 divider-rounded divider-center">&nbsp;&nbsp;or&nbsp;&nbsp;
                                </div>

                                <div class="col-12 form-group">
                                    <label for="mobile"
                                        class="">Mobile </label>

                                    <input id="phone" type="tel"
                                        class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                        value="{{ old('mobile') }}" autocomplete="phone" data-parsley-pattern="^[6-9]\d{9}$">
                                        <span id="mobile_error"></span>
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-12 form-group">
                                    <button class="button button-3d button-primary m-0" id="login-form-submit"
                                        name="login-form-submit" value="register" type="submit">Login</button>
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
                                    New to Finest 50? <a href="{{ route('signup') }}">Create account</a>
                                </div>

                            </form>

                            {{-- OTP FORM --}}
                            <form id="otp-form" name="otp-form" class="row mb-0" method="POST"
                            onsubmit="return verifyotp();" style="display:none">
                                @csrf
                                <div class="col-12 form-group">
                                    <label for="otp"
                                        class="">OTP</label>
                                    <input id="otp" type="text"
                                        class="form-control @error('otp') is-invalid @enderror" name="otp"
                                        value="{{ old('otp') }}" required
                                        autofocus>
                                    @error('otp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-12 form-group">

                                    Resend OTP <a href="javascript:resendotp();">Resend</a>
                                </div>

                                <div class="col-12 form-group">
                                    <button class="button button-3d button-primary m-0" id="otp-form-submit"
                                        name="otp-form-submit" value="otp" type="submit">Verify</button>
                                </div>

                                <div class="divider my-3"></div>

                                {{-- <div class="col-12 form-group">

                                    New to Finest 50? <a href="{{ route('signup') }}">Create account</a>
                                </div> --}}

                            </form>
                            {{-- OTP FORM --}}

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

@section('js')
<script type="text/javascript">
    var uid=0;
    var redirectto = "{{ url()->previous() }}";
    $(function() {
        $('#login-form').parsley();
    });

    function registerpage() {
        if ($('#login-form').parsley().validate()) {
            var mobile = $("#phone").val();
            var email = $("#email").val();

            if ( email != "" || mobile != "") {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: 'signin',
                    data: {
                        email: email,
                        mobile: mobile
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#otp-form').show();
                            $('#login-form').hide();
                            uid=response.id;
                            console.log("uid - "+ uid);
                        } else {
                            
                            swal("Oops!", response.msg, "warning");
                        }
                    },
                    error: function (reject) {
                            var errors = $.parseJSON(reject.responseText);
                            console.log(errors);
                            $.each(errors.error, function (key, val) {
                                console.log("errors  - ");
                                console.log(key + " - - " + val[0] );

                                $("#" + key + "_error").text(val[0]);
                            });
                    }
                });
            }
            else{
            swal("Oops!", "Enter Mobile or Email",
                    "warning");
                }
        }
        return false;
    }
    function resendotp() {
            if (uid != "" ) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: 'resendotp',
                    data: {
                        uid: uid,
                    },
                    success: function(response) {
                        console.log(response); 
                        if (response.status) {
                            swal("OTP Sent!", "OTP resent", "success");
                        } else {
                            swal("Oops!", "Wrong OTP, Please try again", "warning");
                        }
                    }
                });
            }
            else{
            swal("Oops!", "Something is not right",
                    "warning");
                }
        return false;
    }
</script>
@endsection 
<!-- register  -->
