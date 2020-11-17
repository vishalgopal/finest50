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
                            <h3>{{ __('Register') }}</h3>

                            <form id="register-form" name="register-form" class="row mb-0" method="POST"
                            onsubmit="return registerpage();">
                                @csrf
                                <div class="col-12 form-group">
                                    <label for="name"
                                        class="">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name"
                                        autofocus>
                                        <span id="name_error"></span>
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
                                        value="{{ old('email') }}" autocomplete="email" data-parsley-type="email" data-parsley-trigger="change">
                                        <span id="email_error"></span> 
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <button class="button button-3d button-primary m-0" id="register-form-submit"
                                        name="register-form-submit" value="register" type="submit">Register</button>
                                </div>

                                <div class="divider my-3"></div>

                                <div class="col-12 form-group">

                                    Already have an account? <a href="{{ route('login') }}">{{ __('Login') }}</a>
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

                                <div class="col-12 form-group">

                                    Already have an account? <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                </div>

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
        $('#register-form').parsley();
    });

    function registerpage() {
        if ($('#register-form').parsley().validate()) {
            var name = $("#name").val();
            var mobile = $("#phone").val();
            var email = $("#email").val();

            if (name != "" && ( email != "" || mobile != "")) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: 'optregister',
                    data: {
                        name: name,
                        email: email,
                        mobile: mobile
                    },
                    success: function(response) {
                        if (response.status) {
                            $('#otp-form').show();
                            $('#register-form').hide();
                            swal("Thankyou!",
                                "We have recieved your request, someone from our team will contact you shortly!",
                                "success");
                            uid=response.id;
                            console.log("uid - "+ uid);
                        } else {
                            
                            swal("Oops!", "Something went wrong, Please try again", "warning");
                        }
                    },
                    error: function (reject) {
                        // if( reject.status === 401 ) {
                            var errors = $.parseJSON(reject.responseText);
                            console.log(errors);
                            $.each(errors.error, function (key, val) {
                                console.log("errors  - ");
                                console.log(key + " - - " + val[0] );

                                $("#" + key + "_error").text(val[0]);
                            });
                        // }
                    }
                });
            }
            else{
            swal("Oops!", "Enter Mobile or Email",
                    "warning");
                }
        }

        /* else
       {
        swal("Please Fill All The Details");
       }*/

        return false;
    }
    function verifyotp() {
        if ($('#otp-form').parsley().validate()) {
            var otp = $("#otp").val();
            console.log(otp + " - " + uid);
            if (otp != "" && uid != "" ) {
                console.log(uid);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    url: 'verifyotp',
                    data: {
                        uid: uid,
                        otp: otp,
                        
                    },
                    success: function(response) {
                        console.log(response); 
                        if (response.status) {
                            // window.history.back();
                            window.location.replace(redirectto);
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
        }

        /* else
       {
        swal("Please Fill All The Details");
       }*/

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


