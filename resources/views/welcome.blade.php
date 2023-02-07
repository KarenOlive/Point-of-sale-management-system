<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ config('app.name', 'TechMart') }}</title>

     <!-- Fonts -->
     <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

      <!-- Libraries Stylesheet -->
    <link href="{{ asset('css/owl.carousel.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.min.css')}}">
    <style>
        .navbar-dark .navbar-nav .nav-link.active {
       color: #0b2743e2;
       /* border-bottom: 1px;
       border-bottom-color: #eee; */
       /* border-bottom: 1px solid #fff; */
     }

     .navbar-dark .navbar-nav .nav-link:hover{
        color: #0b2743;
     }

     .carousel-caption {
        background: #343957a0;
     }

     @media (max-width: 991.98px){
        .container-fluid.nav-bar{
        background: #343957;

}
     }

    </style>
</head>
<body>
    <div class="container-fluid p-0 nav-bar">
        <nav class="navbar navbar-expand-lg bg-none navbar-dark py-3">
            <a href="/" class="navbar-brand px-lg-4 m-0">
                <h1 class="m-0 display-6 text-uppercase text-white">TechMart</h1>
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                <div class="navbar-nav ml-auto p-4">
                    <a href="/" class="nav-item nav-link active">Home</a>
                    @auth
                    <a href="{{ route('dashboard') }}" class="nav-item nav-link ">Dashboard</a>
                    @else
                    <a href="{{ route('login') }}" class="nav-item nav-link ">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-item nav-link ">Register</a>
                    @endif
                    @endauth
                </div>
            </div>
        </nav>
    </div>
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div id="blog-carousel" class="carousel slide overlay-bottom" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" style="height: 100vh" src="{{asset('img/bg-2.jpeg')}}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class=" text-white display-4 font-weight-bold m-0 text-monospace">WELCOME TO <b style="color: #0b2743">TECHMART</b></h2>
                        <h3 class="display-6 m-0 text-opacity-75 " style="color: #e6e8f3; text-shadow: 3px 3px 1px #060505e1;">Make Your Business More Profitable</h3>
                        <h3 class="text-white m-0"></h3>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" style="height: 100vh" src="{{asset('img/bg-w.jpeg')}}" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <h2 class=" text-white display-4 font-weight-bold m-0 text-monospace">WELCOME TO <b style="color: #0b2743"> TECHMART </b></h2>
                        <h3 class="display-6 m-0" style="color: #e6e8f3; text-shadow: 3px 3px 1px #060505e1;">Make Your Business More Profitable</h3>
                        <h3 class="text-white m-0"></h3>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#blog-carousel" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#blog-carousel" data-slide="next">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
    <!-- Carousel End -->
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/main.js')}}"></script>
</body>
</html>



