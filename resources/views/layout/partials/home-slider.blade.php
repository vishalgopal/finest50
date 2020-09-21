<!-- Slider
		============================================= -->
		<section id="slider" class="slider-element min-vh-100">
			<div class="slider-inner">

				<div class="vertical-middle">
					<div class="container text-center">
						<div class="row justify-content-center">
							<div class="col-md-8">
								<img src="{{ asset('images/Finest50-logo.svg') }}" alt="Finest50 logo" class="Finest50-logo">
								<div class="slider-title mb-5 dark clearfix">
									<h2 class="text-white text-rotater mb-2" data-separator="," data-rotate="fadeIn" data-speed="3500">Search and get Help with <span class="t-rotate text-white">Doctor,Lawyer,Teacher,Business,Lifestyle,Accounts,Health,Fitness,Music</span>.</h2>
									<p class="lead mb-0 text-uppercase ls2" style="color: #CCC; font-size: 110%">What Do You Want To Know?</p>
								</div>
								<div class="clear"></div>
								<div class="input-group input-group-lg mt-1 home-searchbar">
									
									<input class="form-control rounded border-0 main-search" type="search" placeholder="Search ends here.." aria-label="Search">
									<div class="form-group">
									<select id="single" class="form-control select2-single">
										@foreach ($locations as $location)
											<option value="{{ $location->city}}">{{ $location->title}}</option>
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

				<!-- HTML5 Video Wrap
				============================================= -->
				<div class="video-wrap">
					<!-- <video id="slide-video" poster="demos/course/images/video/poster.jpg" preload="auto" loop autoplay muted>
						<source src='images/video/sample.mp4' type='video/mp4' />
					</video> -->
					<img src="{{ asset('images/home/banner3.jpg') }}" class="home-full-banner" alt="Finest50 Banner">
					<div class="video-overlay" style="background: rgba(0,0,0, 0.55); z-index: 1"></div>
				</div>

			</div>
		</section>