		<!-- Top Bar
		============================================= -->
		<div class="position-relative header-inner">
		<div id="top-bar" class="top-bar">
			
			<div class="container clearfix">				
			
			<div class="row justify-content-between">	

					<div class="col-12 px-0 d-md-block d-lg-none">
						<div class="d-flex justify-content-center">
						<!-- Top Links
						============================================= -->
						<div class="top-links">
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
							<li><a href="tel:+91 9999999999" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">+91 9898989898</span></a></li>
							<li><a href="mailto:info@finest50.com" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">info@finest50.com</span></a></li>
						</ul><!-- #top-social end -->

						@guest
							<a href="{{ route('login') }}"><div class="btn login-btn mobile-btn">{{ __('Login') }}</div></a>
						@else
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<div class="btn login-btn mobile-btn">
									{{ __('Logout') }}
								</div>
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						@endguest
						</div>

					</div>	


					<div class="col-12 px-0 d-md-none d-none d-lg-block">
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
							<li><a href="#" target="_blank" class="si-facebook"><span class="ts-icon"><i class="icon-facebook"></i></span></a></li>
							<li><a href="#" target="_blank" class="si-twitter"><span class="ts-icon"><i class="icon-twitter"></i></span></a></li>
							<li><a href="#" target="_blank" class="si-instagram"><span class="ts-icon"><i class="icon-instagram2"></i></span></a></li>
							<li><a href="#" target="_blank" class="si-linkedin"><span class="ts-icon"><i class="icon-linkedin"></i></span></a></li>
							<li><a href="#" target="_blank" class="si-quora"><span class="ts-icon"><i class="icon-quora"></i></span></a></li>
							<li><a href="tel:+91 9999999999" class="si-call"><span class="ts-icon"><i class="icon-call"></i></span><span class="ts-text">+919898989898</span></a></li>
							<li><a href="mailto:info@finest50.com" class="si-email3"><span class="ts-icon"><i class="icon-envelope-alt"></i></span><span class="ts-text">info@finest50.com</span></a></li>
						</ul><!-- #top-social end -->
						</div>

					</div>


				</div>				

			</div>


		</div>
		<!-- top bar end -->

		<!-- logo part -->
		<div class="header1 inner-header2">
		<div class="container">	
		
		<div class="row justify-content-between align-items-center">
					<div class="col">
						<a href="{{ URL::to('/') }}" class="black-logo"><img src="{{ asset('images/Finest50-logo-black.svg') }}" class="inner-logo"></a>
						<a href="{{ URL::to('/') }}" class="white-logo" style="display: none;"><img src="{{ asset('images/Finest50-logo.svg') }}" class="inner-logo"></a>
					</div>
					<div class="col-12 col-lg-auto">
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

					
						<div class="col-12 col-lg-auto">

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

						</nav><!-- #second-menu end -->

					</div>

					</div>

					<div class="col col-auto d-none d-lg-block hide-search">
						<a href="#"><div class="btn btn-outline-primary search-btn-inner"><i class="icon-line-search"></i></div></a>
					</div>

					<div class="col col-auto">
						@guest
							<a href="{{ route('login') }}"><div class="btn login-btn desktop-btn">{{ __('Login') }}</div></a>
						@else
							<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
								<div class="btn login-btn desktop-btn">
									{{ __('Logout') }}
								</div>
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form>
						@endguest
					</div>
				</div>	
		</div>	

		<div class="mini-search">
			<div class="shadow">					
					
						<div class="input-group input-group-lg mt-1 home-searchbar">
									
									<input class="form-control rounded border-0 main-search" type="search" placeholder="Search ends here.." aria-label="Search">
									<div class="form-group mb-0">
									<select id="single" class="form-control select2-single">
										@foreach ($locations as $location)
											<option value="{{$location->slug}}">{{ $location->title }}</option>
										@endforeach
									</select>
									</div>
									<div class="input-group-append search-btn">
										<button class="btn" type="submit"><i class="icon-line-search font-weight-bold"></i></button>
									</div>
								</div>
					</div>
		</div>

		</div>	

	</div>