<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
   
<meta name="baseurl" content="{{ env('APP_URL') }}">
    
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Finest 50 </title>
    
    <link href="{{asset('images/favicon.png')}}" rel="shortcut icon" type="image/png">

    @include ('admin.layouts.css')
    @stack ('styles')
</head>
<body>    
    <div class="wrapper">        
  		@include ('admin.layouts.header')
            <!-- Page Content Holder -->
            <div id="content">
    
                @include ('admin.layouts.h_navbar')
                @yield('content')
                
            </div>
        </div>
        
@include ('admin.layouts.footer')
@include ('admin.layouts.js')
@stack ('scripts')
</body>
</html>
