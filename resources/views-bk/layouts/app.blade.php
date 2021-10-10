<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@hasSection('title') @yield('title') | {{ config('app.name', 'Laravel') }} @else {{ config('app.name', 'Laravel') }} @endif</title>
    <meta name="description" content="FDA E-submission">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" href="">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">
</head>

<body>

    <!-- Loader Class written in app-header.css -->
    <div class="page-loader-div"><img src="{{ asset('images/ajax-loader.gif') }}" alt="Loader"></div>
 
    @include('layouts.sidebar')

    <div id="right-panel" class="right-panel">
        @include('layouts.header')
        <div class="container-fluid">
            @include('layouts.message')
            @yield('content')
        </div>
        <br>
    </div><!-- /#right-panel --> 
    <!-- Right Panel -->
    <script src="{{ asset('js/all.js')}}"></script>
    @auth
        @if( !auth()->user()->isLabAdmin() )
          <script src="{{ asset('js/enforcement.js') }}"></script>
        @endif
        @if( auth()->user()->isLabAdmin() )
          <script src="{{ asset('js/drug-lab-section.js') }}"></script>
        @endif 
    @endauth 
    @yield('css')
    @yield('js')
    <script>
       $(function(){
         $('.page-loader-div').remove();
       });
    </script>
</body>
</html>