<!doctype html>
 <html lang="en">
 <head>
 <meta charset="UTF-8">
 <title></title>
 </head>
 <body>
@include('partials.header')
@yield('body')
@include('partials.base')
{{-- @include('partials.base') --}}
{{--  <script src="{{ mix('js/app.js') }}"></script> --}}
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
 </body>
 </html>
 
 <!-- <!doctype html>
 <html lang="en">
 <head>
 <meta charset="UTF-8">
 <title></title>
 </head>
 <body>
 	{{-- @include('layouts.app') --}}

 	@include('partials.header')

 @yield('body')

 @include('layouts.header')
 <link href="{{ url('src/css/app.css') }}" rel="stylesheet" type="text/css" >
{{--  <script src="{{ mix('js/app.js') }}"></script> --}}
    <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
    @stack('scripts')
 </body>
 </html> -->