<!-- Footer
		============================================= -->
		<footer id="footer" class="light" style="background-color:#fff;">
			<div class="container">
				<!-- Footer Widgets
				============================================= -->
				<div class="footer-widgets-wrap">

					<div class="row col-mb-50">
						<div class="col-md-8">
							<div class="widget clearfix">

								<div class="row">
									<a href="index.php"><img src="{{ asset('images/Finest50-logo-black.svg') }}" alt="Image" class="footer-logo col"></a>
								</div>
								<div class="row col-mb-30">
									<div class="col-6 col-lg-3 widget_links">
										<ul>
											<li><a href="{{ URL::to('/')}}">Home</a></li>
											<li><a href="{{ URL::to('/about')}}">About</a></li>
											<li><a href="{{ URL::to('/blogs')}}">Stories</a></li>
											<li><a href="#">FAQs</a></li>
											<li><a href="#">Q&A</a></li>
										</ul>
									</div>

									<div class="col-6 col-lg-3 widget_links">
										<ul>
											<li><a href="#">Doctors</a></li>
											<li><a href="#">Lawyers</a></li>
											<li><a href="#">Finance</a></li>
											<li><a href="#">Music</a></li>
											<li><a href="#">Design</a></li>
										</ul>
									</div>

									<div class="col-6 col-lg-3 widget_links">
										<ul>
											<li><a href="#">Web Development</a></li>
											<li><a href="#">Ecommerce</a></li>
											<li><a href="#">Real Estate</a></li>
											<li><a href="#">Mortgage</a></li>
											<li><a href="#">Business</a></li>
										</ul>
									</div>

									<div class="col-6 col-lg-3 widget_links">
										<ul>
											<li><a href="#">Taxation</a></li>
											<li><a href="#">Wedding</a></li>
											<li><a href="#">Health</a></li>
											<li><a href="#">Fittness</a></li>
											<li><a href="#">Lifestyle</a></li>
										</ul>
									</div>
								</div>

							</div>
						</div>

						<div class="col-md-4">
							<div class="widget clearfix" style="margin-bottom: -20px;">

								<div class="row col-mb-30">
									<div class="col-6 col-sm-6 col-md-12 col-lg-6">
										<div class="counter counter-small" style="color: #35BBAA;"><span data-from="50" data-to="15065421" data-refresh-interval="80" data-speed="3000" data-comma="true">15,065,421</span></div>
										<h5 class="mb-0">Total Users</h5>
									</div>

									<div class="col-6 col-sm-6 col-md-12 col-lg-6">
										<div class="counter counter-small" style="color: #2CAACA;"><span data-from="100" data-to="18465" data-refresh-interval="50" data-speed="2000" data-comma="true">18,465</span></div>
										<h5 class="mb-0">Members</h5>
									</div>
								</div>

							</div>

							<div class="widget subscribe-widget clearfix">
								<h5><strong>Subscribe</strong> to Our Newsletter to get Important News, Amazing Offers &amp; Updates:</h5>
								<div class="widget-subscribe-form-result"></div>
								<form id="widget-newsletter-form" onsubmit="return add_newsletter();"  method="post"  class="mb-0">
									<div class="input-group mx-auto">
										<div class="input-group-prepend">
											<div class="input-group-text bg-primary text-light"><i class="icon-email2"></i></div>
										</div>
										<input type="email" data-parsley-type="email" data-parsley-trigger="change" id="widget-subscribe-form-email" name="widget-subscribe-form-email" required class="form-control" placeholder="Enter your Email">
										<div class="input-group-append">
											<button class="btn btn-primary" type="submit">Subscribe</button>
										</div>
									</div>
								</form>
							</div>

							<div class="widget">
								<div class="row col-mb-30">
									<div class="col-6 col-sm-6 col-md-12 col-lg-6 clearfix">
										<a href="#" class="social-icon si-dark si-colored si-facebook mb-0" style="margin-right: 10px;">
											<i class="icon-facebook"></i>
											<i class="icon-facebook"></i>
										</a>
										<a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
									</div>

									<div class="col-6 col-sm-6 col-md-12 col-lg-6 clearfix">
										<a href="#" class="social-icon si-dark si-colored si-twitter mb-0" style="margin-right: 10px;">
											<i class="icon-rss"></i>
											<i class="icon-rss"></i>
										</a>
										<a href="#"><small style="display: block; margin-top: 3px;"><strong>Follow Us</strong><br>on Twitter</small></a>
									</div>
								</div>
								<div class="row col-mb-30 mt-4">
									<div class="col-6 col-sm-6 col-md-12 col-lg-6 clearfix">
										<a href="#" class="mb-0" style="margin-right: 10px;">
											<img src="{{ asset('images/google-play.png') }}" alt="">
										</a>
									</div>

									<div class="col-6 col-sm-6 col-md-12 col-lg-6 clearfix">
										<a href="#" class="" style="margin-right: 10px;">
										<img src="{{ asset('images/app-store.png') }}" alt="">
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div><!-- .footer-widgets-wrap end -->
			</div>

			<!-- Copyrights
			============================================= -->
			<div id="copyrights">
				<div class="container">

					<div class="row justify-content-between col-mb-30">
						<div class="col-12 col-lg-auto text-center text-lg-left">
							<!-- <div class="copyrights-menu copyright-links clearfix">
								<a href="#">Home</a><a href="#">About</a><a href="#">Members</a><a href="#">Stories</a><a href="#">FAQs</a><a href="#">Contact</a>
							</div> -->
							Copyrights © 2020 All Rights Reserved by Finest 50. 
						</div>

						<div class="col-12 col-lg-auto text-center text-lg-right">
							<a href="#"  class="social-icon inline-block si-small si-borderless mb-0 si-facebook">
								<i class="icon-facebook"></i>
								<i class="icon-facebook"></i>
							</a>

							<a href="#" class="social-icon inline-block si-small si-borderless mb-0 si-twitter">
								<i class="icon-twitter"></i>
								<i class="icon-twitter"></i>
							</a>

							<a href="#" class="social-icon inline-block si-small si-borderless mb-0 si-instagram">
								<i class="icon-instagram2"></i>
								<i class="icon-instagram2"></i>
							</a>

							<a href="#" class="social-icon inline-block si-small si-borderless mb-0 si-linkedin">
								<i class="icon-linkedin"></i>
								<i class="icon-linkedin"></i>
							</a>

							<a href="#" class="social-icon inline-block si-small si-borderless mb-0 si-quora">
								<i class="icon-quora"></i>
								<i class="icon-quora"></i>
							</a>

							
						</div>
					</div>

				</div>
			</div><!-- #copyrights end -->
		</footer><!-- #footer end -->