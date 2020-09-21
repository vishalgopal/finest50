<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="digitallyyours" />	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Finest 50') }} | @yield('title')</title>
    @yield('meta')
    @include('layout.partials.css')
    @yield('css')
</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

	@if(Request::is('/'))
        @include('layout.partials.home-header')
    @else
        @include('layout.partials.header')
    @endif	

    @yield('content', 'It seems there is some problem in loading! We are fixing it. ')

    @include('layout.partials.footer')


	</div><!-- #wrapper end -->
    @include('layout.partials.js')
    @yield('js')
    
</body>

</html>