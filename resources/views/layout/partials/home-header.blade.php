		<!-- Top Bar
		============================================= -->
		<div class="position-relative">
		<div id="top-bar" class="top-bar">
			<div class="container clearfix">
			
			<div class="row justify-content-between">	

					<div class="col-12 px-0 d-md-block d-lg-none">
						<div class="d-flex justify-content-between">
						<!-- Top Links
						============================================= -->
						<div class="top-links ml-5">
							<ul class="top-links-container">
								<li class="top-links-item"><a href="#">Become a Member</a></li> 
								<li class="top-links-item d-none d-sm-inline-block"><a href="#"><i class="icon-download-alt"></i> Download App</a></li>
							</ul>
						</div><!-- .top-links end -->

						<ul id="top-social" class="d-md-none d-none d-lg-block">
							<li><a href="#" target="_blank" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span></a></li>
							<li><a href="#" target="_blank" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span></a></li>
							<li><a href="#" target="_blank" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span></a></li>
							<li><a href="#" target="_blank" class="si-linkedin"><span class="ts-icon"><i class="icon-linkedin"></i></span></a></li>
							<li><a href="#" target="_blank" class="si-quora"><span class="ts-icon"><i class="icon-quora"></i></span></a></li>
							<li><a href="tel:+91 9999999999" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span></a></li>
							<li><a href="mailto:info@finest50.com" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span></a></li>
						</ul><!-- #top-social end -->

						@guest
							<a href="{{ route('login') }}"><div class="btn login-btn mobile-btn mr-3">{{ __('Login') }}</div></a>
						@else					
							<div class="dropdown d-md-block d-block d-lg-none">
							<button class="btn btn-link text-dark dropdown-toggle pt-2" type="button" id="userdropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Vishal
							</button>
							<div class="dropdown-menu" aria-labelledby="userdropdownMenu2">
								<a class="dropdown-item" href="{{ URL::to('/dashboard') }}">Dashboard</a>
								<a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
							</div>
							</div>
							<!-- <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<div class="btn login-btn mobile-btn">
									{{ __('Logout') }}
								</div>
							</a> -->
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						@endguest
						</div>

					</div>	

					<div class="col-12 col-lg-3 px-0">
						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu with-arrows">

							<ul class="menu-container">
								<li class="menu-item"><a class="menu-link" href="#" class="pl-0"><div><i class="icon-line-grid"></i>All Categories</div></a>
									<ul class="sub-menu-container">
										@foreach ($categories as $category)
										<li class="menu-item"><a class="menu-link" href="{{ URL::to('members/'. $category->slug)}}"><div><i class="icon-line2-user"></i>{{ $category->title }}</div></a>
											@if (count($category->children)>0)
											<ul class="sub-menu-container">
												{{-- <li class="menu-item"><a class="menu-link" href="#"><div>All Teacher Training</div></a>
													<ul class="sub-menu-container">
														<li class="menu-item"><a class="menu-link" href="#"><div>Level 3</div></a></li>
													</ul>
												</li> --}}
												@foreach ($category->children as $child)
													<li class="menu-item"><a class="menu-link" href="{{ URL::to('members/'. $child->slug)}}"><div> {{ $child->title }}</div></a></li>
												@endforeach
											</ul>
											@endif
										</li>
										@endforeach
									</ul>
								</li>
							</ul>

						</nav><!-- #primary-menu end -->
					</div>

					<div class="col-12 col-lg-6 px-0 d-md-none d-none d-lg-block">
						<div class="d-flex justify-content-center">
						<!-- Top Links
						============================================= -->
						<div class="top-links">
							<ul class="top-links-container">
								<li class="top-links-item"><a href="#">Become a Member</a></li> 
								<li class="top-links-item d-none d-sm-inline-block"><a href="#"><i class="icon-download-alt"></i> Download App</a></li>
							</ul>
						</div><!-- .top-links end -->

						<ul id="top-social">
							<li><a href="#" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span></a></li>
							<li><a href="#" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span></a></li>
							<li><a href="#" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span></a></li>
							<li><a href="#" class="si-linkedin"><span class="ts-icon"><i class="icon-linkedin"></i></span></a></li>
							<li><a href="#" class="si-quora"><span class="ts-icon"><i class="icon-quora"></i></span></a></li>
							<li><a href="tel:+91 9999999999" class="si-call"><span class="ts-icon"><i class="icon-call"></i></a></li>
							<li><a href="mailto:info@finest50.com" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span></a></li>
						</ul><!-- #top-social end -->
						</div>

					</div>

					<div class="col-12 col-lg-3 px-0">

						<!-- <a href="login.php"><div class="btn login-btn desktop-btn">Login</div></a> -->
						@guest
							<a href="{{ route('login') }}"><div class="btn login-btn desktop-btn">{{ __('Login') }}</div></a>
						@else
						<div class="dropdown float-left  d-md-none d-none d-lg-block">
						<button class="btn btn-link text-light dropdown-toggle" type="button" id="userdropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Vishal
						</button>
						<div class="dropdown-menu" aria-labelledby="userdropdownMenu2">
							<a class="dropdown-item" href="{{ URL::to('/dashboard') }}">Dashboard</a>
							<a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
						</div>
						</div>
							<!-- <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<div class="btn login-btn desktop-btn">
									{{ __('Logout') }}
								</div>
							</a> -->
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						@endguest
						<div class="second-menu">
						<nav class="primary-menu with-arrows">

							<ul class="menu-container">
								<li class="menu-item"><a class="menu-link hide-icon-angle-down" href="#" class="pl-0"><div><i class="icon-line-menu"></i> Menu</div></a>
									<ul class="sub-menu-container">
										<li class="menu-item"><a class="menu-link" href="{{ URL::to('/') }}"><div><i class="icon-line2-home"></i>Home</div></a>
										</li>
										<li class="menu-item"><a class="menu-link" href="{{ URL::to('about') }}"><div><i class="icon-line2-info"></i>About Us</div></a>
										</li>
										<li class="menu-item"><a class="menu-link" href="{{ URL::to('/members') }}"><div><i class="icon-line2-users"></i>Members</div></a>
											{{-- <ul class="sub-menu-container">
												<li class="menu-item"><a class="menu-link" href="#"><div>Member 1</div></a></li>
												<li class="menu-item"><a class="menu-link" href="#"><div>Member 2</div></a></li>
												<li class="menu-item"><a class="menu-link" href="#"><div>Member 3</div></a></li>
												<li class="menu-item"><a class="menu-link" href="#"><div>Member 4</div></a></li>
												<li class="menu-item"><a class="menu-link" href="#"><div>Member 5</div></a></li>
											</ul> --}}
										</li>
										<li class="menu-item"><a class="menu-link" href="{{ URL::to('/blogs') }}"><div><i class="icon-line2-support"></i>Stories</div></a>
										</li>
										<li class="menu-item"><a class="menu-link" href="{{ URL::to('/faq') }}"><div><i class="icon-line2-question"></i>FAQs</div></a>
										</li>
										<li class="menu-item"><a class="menu-link" href="{{ URL::to('/partners') }}"><div><i class="icon-handshake1"></i>Partners</div></a>
										</li>
										<li class="menu-item"><a class="menu-link" href="{{ URL::to('/questions') }}"><div><i class="icon-line2-question"></i>Q&A</div></a>
										</li>
										<li class="menu-item"><a class="menu-link" href="{{ URL::to('/contact') }}"><div><i class="icon-line2-screen-smartphone"></i>Contact Us</div></a>
										</li>
										
									</ul>
								</li>
							</ul>

						</nav><!-- #primary-menu end -->

					</div>
					</div>	


				</div>

			</div>
		</div>
	</div>

	<div class="alert alert-success" role="alert" style="position: absolute; right: 25px; top: 70px; z-index: 4;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
   You have been signed in successfully!<br>
   <a href="{{ URL::to('/dashboard') }}"><strong>Go to Dashboard</strong></a>
</div>