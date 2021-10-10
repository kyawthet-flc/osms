<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib-one.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/lib-two.css') }}">

    @yield('plugin-css')

    <!-- <link rel="shortcut icon" href="{{ asset('rtad/assets/images/sme_logo.png') }}" /> -->
    <style type="text/css">
        /* @font-face {
            font-family: Pyidaungsu;
            font-weight: bold;
            src: url({{asset('Pyidaungsu.ttf')}}) format("opentype");
        }
        html,body,p,div,*,table,h1,h2,h3,h4,h5,h6,a,tr,th,td,thead,tbody {
            font-family: Pyidaungsu;
        },
        .form-control{
            border: 1px solid #bcb5b5;
        }
        .table thead th, .jsgrid .jsgrid-table thead th,
        .table td, .jsgrid .jsgrid-table td {
            font-family: Pyidaungsu !important;
        } */
    </style>
 
    </head>
    
  <body>
    <div class="container-scroller">
         <!-- partial:partials/_navbar.html -->
         @auth
           @include('layouts.navbar')
          @endauth
  <!-- partial -->

  <div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    @auth
      @include('layouts.sidebar')
    @endauth
    <!-- partial -->

    <div class="main-panel">
      <div class="content-wrapper">
        @yield('content')
      </div>
      <!-- content-wrapper ends -->

      <!-- partial:partials/_footer.html -->
      @include('layouts.footer')
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
    </div>

    <script type="text/javascript" src="{{ asset('js/lib-one.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lib-two.js') }}"></script>

    @yield('plugin-js')    
    @yield('custom-js')
    @yield('custom-css')
    
  </body>
</html>