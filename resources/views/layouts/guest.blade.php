<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TechMart') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <style>
        label {
            color: rgba(255, 255, 255, 0.897) !important;
        }

        /* button[type=submit]{
            background-color: #696CFF;
        } */

        .login-wrap {
            position: relative;
            background: #1c1f4cc7;
            border-radius: 5px;
            padding-left: 30px;
            padding-right: 30px;
            -webkit-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
            -moz-box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
            box-shadow: 0px 10px 34px -15px rgba(0, 0, 0, 0.24);
        }

        .login-wrap h2 {

            font-size: 20px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .login-wrap p {
            color: rgba(255, 255, 255, 0.65);
        }

        .login-wrap .img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin: 0 auto;
            margin-bottom: 20px;
        }

        body {
            background: #1c1f4cc9;
           
        }

        .form-group {
            position: relative;
        }

        .form-group .icon {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            width: 20px;
            height: 48px;
            background: transparent;
            font-size: 18px;
        }

        .form-group .icon span {
            color: #fff;
        }
    </style>
    @yield('styles')
</head>

<body>
    <div class="container">
        @yield('content')
    </div>




    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
