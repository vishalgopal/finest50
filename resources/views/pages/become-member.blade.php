@extends('layout.main')

@section('title', 'Become a Member')

@section('meta')

@endsection
@section('content')
  <!-- Page Title
		============================================= -->
		<section id="page-title">

			<div class="container clearfix">
				<h1>Become a Member</h1>
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="{{ URL::to('/')}}">Home</a></li>
					<li class="breadcrumb-item active" aria-current="page">Become a Member</li>
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
								<h3>Become a Member</h3>
						</div>
							<div class="form-widget">

								<div class="form-result"></div>

								<form class="mb-0" enctype="multipart/form-data" id="contactform" name="contactform" method="post">
                                    @csrf
									<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6 form-group">
											<label for="name">Name <small>*</small></label>
                                            <input type="text" id="name" name="name" required class="form-control required" />
                                            <span id="name_error"></span> 
										</div>

										<div class="col-md-6 form-group">
											<label for="email">Email <small>*</small></label>
                                            <input type="email" data-parsley-type="email" data-parsley-trigger="change" id="email" name="email" required class="form-control" />
                                            <span id="email_error"></span> 
										</div>

										<div class="col-md-6 form-group">
											<label for="phone">Phone</label>
											<div class="row">
											<div class="col-4 col-sm-3">											
												<select id="phone_code" name="phone_code" class="form-control p-0" >
													<option value="+91" selected>+91</option>
												</select>
											</div>		
											<div class="col-8 col-sm-9 pl-0">
                                                <input type="text" id="phone" name="phone" data-parsley-pattern="^[6-9]\d{9}$" required class="form-control" />
                                                <span id="phone_error"></span> 
											</div>
											</div>
										</div>

										{{-- <div class="w-100"></div> --}}
                                        <div class="col-md-6 form-group">
                                            <div class="col-md-12 form-group">
                                                <label for="address">Address</label>
                                                <textarea id="address" name="address" class="required form-control"></textarea>
                                                <span id="address_error"></span> 
                                            </div>
                                        </div>

										<div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="document_of_experience">Document of Experience</label>
                                                <br><input type="file" id="document_of_experience" name="document_of_experience" />
                                                <span id="document_of_experience_error"></span> 
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="certificate">Certificate</label>
                                                <br><input type="file" id="certificate" name="certificate" />
                                                <span id="certificate_error"></span> 
                                            </div>
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#contactform').submit(function (e) {
                    e.preventDefault();
                    if ($('#contactform').parsley().validate()) {
                    var formData = new FormData(this);
                    $.ajax({
                        type: 'POST',
                        url: APP_URL + '/become-a-member',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            this.reset();
                            swal("Thankyou!",
                                    "We have recieved your request, someone from our team will contact you shortly!",
									"success");
                        },
                        error: function (reject) {
                            
                            var errors = $.parseJSON(reject.responseText);
                            $.each(errors.errors, function (key, val) {
                                console.log(key + " - - " + val);
                                $("#" + key + "_error").text(val);
                            });
                        }
                    });
                    $(".form-process").css({
										"display": "none"
									});
                                    this.reset();
            }
            });
    </script>
@endsection