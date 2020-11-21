
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">
        <meta charset="utf-8" />
            <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Finest 50') }} | @yield('title')</title>
        @yield('meta')
        @include('layout.partials.dashboard.css')
        @yield('css')
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
        @include('layout.partials.dashboard.mobile-header')

		<!--begin::Main-->	
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
                @include('layout.partials.dashboard.sidebar')

				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

					<!--begin::Header-->
					<div id="kt_header" class="header bg-white header-fixed">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Left-->
							<div class="d-flex align-items-stretch mr-2">
								<!--begin::Page Title-->
								{{-- <h3 class="d-none text-dark d-lg-flex align-items-center mr-10 mb-0">Dashboard</h3> --}}
								<!--end::Page Title-->
                    @include('layout.partials.dashboard.header')
					

					</div>
						<!--end::Container-->
					</div>
					<!--end::Header-->

					@yield('content')
                    @include('layout.partials.dashboard.footer')
					
				</div>
				<!--end::Wrapper-->
			</div>
			<!--end::Page-->
		</div>
		<!--end::Main-->
		


        @include('layout.partials.dashboard.user-panel')
        @include('layout.partials.dashboard.chat')
        @include('layout.partials.dashboard.js')
        @yield('js')
	</body>
	<!--end::Body-->
</html>