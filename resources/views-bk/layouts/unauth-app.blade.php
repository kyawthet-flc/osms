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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>K&K Onlineshop Manager</title>
    <meta name="description" content="K&K Onlineshop Manager">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/admin-template.css')}}">
    <style>
        .title {
            color: white;
            text-align: center;
            font-size: 33px;
        }
    </style>
</head>

<body class="bg-white">
    <div class="sufee-login d-flex align-content-center flex-wrap">
    @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/admin-template.js')}}"></script>
</body>

</html>
