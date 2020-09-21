@extends('layout.main')

@section('title', 'About Us')

@section('meta')

@endsection
@section('content')
  <!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Contact Us</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.php">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Contact Us</li>
				</ol>
			</div>

		</section><!-- #page-title end -->

		<!-- Content
		============================================= -->
		<section id="content" class="contact-bg">
			<div class="content-wrap">
				<div class="container clearfix">
					<div class="row align-items-stretch col-mb-50 mb-0">
						<!-- Contact Form
						============================================= -->
						<div class="col-lg-8 offset-lg-2">

							<div class="card">
								<div class="card-body">
<div class="fancy-title title-border">
								<h3>Send us an Email</h3>
						</div>
							<div class="form-widget">

								<div class="form-result"></div>

								<form class="mb-0" id="contactform" name="contactform" onsubmit="return save_contact();" method="post">
                                    @csrf
									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 form-group">
											<label for="contactform-name">First Name <small>*</small></label>
											<input type="text" id="contactform-firstname" name="contactform-firstname" required class="form-control required" />
										</div>

										<div class="col-md-6 form-group">
											<label for="contactform-name">Last Name </label>
											<input type="text" id="contactform-lastname" name="contactform-lastname" required class="form-control required" />
										</div>

										<div class="col-md-6 form-group">
											<label for="contactform-email">Email <small>*</small></label>
											<input type="email" data-parsley-type="email" data-parsley-trigger="change" id="contactform-email" name="contactform-email" required class="form-control" />
										</div>

										<div class="col-md-6 form-group">
											<label for="contactform-phone">Phone</label>
											<div class="row">
											<div class="col-4 col-sm-3">											
												<select id="contactform-phone_code" name="contactform-phone_code" class="form-control p-0" >
													<option>+91</option>
													<option>+345</option>
													<option>+123</option>
													<option>+95</option>
													<option>+191</option>
												</select>
											</div>		
											<div class="col-8 col-sm-9 pl-0">
												<input type="text" id="contactform-phone" name="contactform-phone" data-parsley-pattern="^[6-9]\d{9}$" required class="form-control" />
											</div>
											</div>
										</div>

										<div class="w-100"></div>

										<div class="col-md-6 form-group">
											<label for="contactform-subject">Subject</label>
											<input type="text" id="contactform-subject" name="subject" class="required form-control" />
										</div>

										<div class="col-md-6 form-group">
											<label for="contactform-category_id">Topic</label>
											<select id="contactform-category_id" name="contactform-category_id" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endforeach
											</select>
										</div>

										<div class="w-100"></div>

										<div class="col-12 form-group">
											<label for="contactform-message">Message <small>*</small></label>
											<textarea class="required form-control" id="contactform-message" name="contactform-message" rows="4" cols="30"></textarea>
										</div>

										<div class="col-12 form-group d-none">
											<input type="text" id="contactform-botcheck" name="contactform-botcheck" class="form-control" />
										</div>

										<div class="col-12 form-group">
											<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d m-0">Submit</button>
										</div>
									</div>

									<input type="hidden" name="prefix" value="contactform-">

								</form>
							</div>
									
								</div>
							</div>

						</div><!-- Contact Form End -->

					</div>
				</div>	
				
				<div class="container-fluid contact-footer">
<!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" preserveAspectRatio="none">
                                        <path class="elementor-shape-fill" d="M0,6V0h1000v100L0,6z"></path>
                                        </svg> -->
					<div class="row">
						<div class="container">					
						

					<!-- Contact Info
					============================================= -->
					<div class="row col-mb-50">
						<div class="col-sm-6 col-lg-3">
							<div class="feature-box fbox-center fbox-bg fbox-plain card hover-effect">
								<div class="fbox-icon">
									<a href="#"><i class="icon-map-marker2"></i></a>
								</div>
								<div class="fbox-content">
									<h4>Our Headquarters<br><span class="subtitle">Dubai</span></h4>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-lg-3">
							<div class="feature-box fbox-center fbox-bg fbox-plain card hover-effect">
								<div class="fbox-icon">
									<a href="#"><i class="icon-phone3"></i></a>
								</div>
								<div class="fbox-content">
									<h4>Speak to Us<br><span class="subtitle">(123) 456 7890</span></h4>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-lg-3">
							<div class="feature-box fbox-center fbox-bg fbox-plain card hover-effect">
								<div class="fbox-icon">
									<a href="#"><i class="icon-skype2"></i></a>
								</div>
								<div class="fbox-content">
									<h4>Make a Video Call<br><span class="subtitle">Finest50 OnSkype</span></h4>
								</div>
							</div>
						</div>

						<div class="col-sm-6 col-lg-3">
							<div class="feature-box fbox-center fbox-bg fbox-plain card hover-effect">
								<div class="fbox-icon">
									<a href="#"><i class="icon-twitter2"></i></a>
								</div>
								<div class="fbox-content">
									<h4>Follow on Twitter<br><span class="subtitle">2.3M Followers</span></h4>
								</div>
							</div>
						</div>
					</div><!-- Contact Info End -->

					</div>
					</div>

				</div>
			</div>
		</section><!-- #content end -->
    </section><!-- #content end -->

@endsection


@section('js')

    <script type="text/javascript">
        $(function() {
			$('#contactform').parsley();
        });

        function save_contact() {
            if ($('#contactform').parsley().validate()) {
                var firstname = $("#contactform-firstname").val();
                var lastname = $("#contactform-lastname").val();
                var email = $("#contactform-email").val();
                var phone = $("#contactform-phone").val();
                var category_id = $("#contactform-category_id").val();
				var subject = $("#contactform-subject").val();
				var message = $("#contactform-message").val();
				var phone_code = $("#contactform-phone_code").val();
				
                if (firstname != "" && email != "") {
                    $(".form-process").css({
                        "display": "block"
                    });
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        type: 'post',
                        url: 'contact/submit',
                        data: {
                            firstname: firstname,
                            lastname: lastname,
                            email: email,
                            phone: phone,
                            category_id: category_id,
                            subject: subject,
                            message: message,
                            phone_code: phone_code,
                        },
                        success: function(response) {
                            if (response.status) {
                                swal("Thankyou!",
                                    "We have recieved your request, someone from our team will contact you shortly!",
									"success");
									$(".form-process").css({
										"display": "none"
									});
                            } else {
                                swal("Oops!", "Something went wrong, Please try again", "warning");
                            }
                        }
                    });
					swal("Thankyou!", "We have recieved your request, someone from our team will contact you shortly!", "success");
					$(".form-process").css({
						"display": "none"
					});
                }
            }

            /* else
       {
        swal("Please Fill All The Details");
       }*/

            return false;
        }

    </script>
@endsection