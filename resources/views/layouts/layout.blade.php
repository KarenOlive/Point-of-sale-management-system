<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TechMart') }}</title>



    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('/css/bootstrap-datetimepicker.min.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

    <style>
        .popupheader {
            background-color: dodgerblue;
            color: white;
        }

        .fade {
            opacity: 1;
        }

        .modal-backdrop {
            background: rgba(0, 0, 0, 0.5);
        }

        /*left right modal*/
        .modal.left_modal,
        .modal.right_modal {
            position: fixed;
            z-index: 99999;
        }

        .modal.left_modal .modal-dialog,
        .modal.right_modal .modal-dialog {
            position: fixed;
            margin: auto;
            width: 32%;
            height: 60%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal-dialog {

            margin: 1.75rem auto;
        }

        @media (min-width: 576px) {
            .left_modal .modal-dialog {
                max-width: 100%;
            }

            .right_modal .modal-dialog {
                max-width: 100%;
            }
        }

        .modal.left_modal .modal-content,
        .modal.right_modal .modal-content {

            height: 60vh !important;
        }

        .modal.left_modal .modal-body,
        .modal.right_modal .modal-body {
            padding: 15px 15px 30px;
        }


        .modal-backdrop {
            display: none;
        }

        /*Left*/
        .modal.left_modal.fade .modal-dialog {
            left: -50%;
            -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
            -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
        }

        .modal.left_modal.fade.show .modal-dialog {
            left: 0;
            box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
        }

        /*Right*/
        .modal.right_modal.fade .modal-dialog {
            right: -50%;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }



        .modal.right_modal.fade.show .modal-dialog {
             margin-top: 50px;
            right: 0;
            box-shadow: 0px 0px 19px rgba(0, 0, 0, .5);
        }

        /* ----- MODAL STYLE ----- */
        .modal-content {
            border-radius: 0;
            border: none;
        }



        .modal-header.left_modal,
        .modal-header.right_modal {

            padding: 10px 15px;
            border-bottom-color: #EEEEEE;
            background-color: #FAFAFA;
        }

        .modal_outer .modal-body {
            /*height:90%;*/
            overflow-y: auto;
            overflow-x: hidden;
            height: 60vh;
        }

        button[type=button] {
            background-color: #000;
        }

        button[type=submit] {
            background-color: #5757d3;
            color: #eee;
        }
    </style>



    <!-- Styles -->
    @yield('styles')



</head>

<body>
    @include('sweetalert::alert')

    <div class="main-wrapper">
        <div class="header">
            <div class="header-left">
                <a href="/" class="logo">
                    <img src="{{ asset('/favicon.ico') }}" width="35" height="35" alt="">
                    <span>TechMart</span>
                </a>
            </div>
            <a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><i
                            class="fa fa-bell-o"></i> <span class="badge badge-pill bg-danger float-right">3</span></a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span>Notifications</span>
                        </div>
                        <div class="drop-scroll">
                            <ul class="notification-list">
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">
                                                <img alt="John Doe" src="assets/img/user.jpg" class="img-fluid">
                                            </span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">John Doe</span> added
                                                    new task <span class="noti-title">Patient appointment booking</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">4 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">V</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Tarah Shropshire</span>
                                                    changed the task name <span class="noti-title">Appointment booking
                                                        with payment gateway</span></p>
                                                <p class="noti-time"><span class="notification-time">6 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">L</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Misty Tison</span>
                                                    added <span class="noti-title">Domenic Houston</span> and <span
                                                        class="noti-title">Claire Mapes</span> to project <span
                                                        class="noti-title">Doctor available module</span></p>
                                                <p class="noti-time"><span class="notification-time">8 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="#">
                                        <div class="media">
                                            <span class="avatar">G</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Rolland Webber</span>
                                                    completed task <span class="noti-title">Patient and Doctor video
                                                        conferencing</span></p>
                                                <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="notification-message">
                                    <a href="">
                                        <div class="media">
                                            <span class="avatar">V</span>
                                            <div class="media-body">
                                                <p class="noti-details"><span class="noti-title">Bernardo
                                                        Galaviz</span>
                                                    added new task <span class="noti-title">Private chat module</span>
                                                </p>
                                                <p class="noti-time"><span class="notification-time">2 days ago</span>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="topnav-dropdown-footer">
                            <a href="#">View all Notifications</a>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown d-none d-sm-block">
                    <a href="javascript:void(0);" id="open_msg_box" class="hasnotifications nav-link"><i
                            class="fa fa-comment-o"></i> <span
                            class="badge badge-pill bg-danger float-right">8</span></a>
                </li>

                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
                            <img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="">
                            <span class="status online"></span>
                        </span>
                        @if (Auth::user()->name)
                            <span>{{ Auth::user()->name }}</span>
                        @else
                            {{ route('login') }}
                        @endif

                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a>

                        <a class="dropdown-item" href="#">Settings</a>

                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-jet-dropdown-link>
                        </form>

                    </div>
                </li>

                {{-- <li class="nav-item dropdown has-arrow">
                    @livewire('navigation-menu')
                </li> --}}
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i
                        class="fa fa-ellipsis-v"></i>

                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if (Auth::user()->name)
                        <span class="dropdown-item">{{ Auth::user()->name }}</span>
                        <hr>
                    @else
                        {{ route('login') }}
                    @endif

                    <a class="dropdown-item" href="{{ route('profile.show') }}">My Profile</a>

                    <a class="dropdown-item" href="#">Settings</a>

                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                            {{ __('Log Out') }}
                        </x-jet-dropdown-link>
                    </form>
                </div>
            </div>
        </div>


        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>
                                <span>Dashboard</span></a>
                        </li>
                        @if (Auth::user()->role == 1)
                            <li>
                                <a href="{{ route('users.index') }}"><i class="fa fa-user-o"></i>
                                    <span>Users</span></a>
                            </li>
                        @endif
                        {{-- ---------------------------- cashier, manager, admin ----------------------------------------- --}}
                        @if (Auth::user()->role > 0)
                            <li>
                                <a href="{{ route('order.create') }}"><i class="fa fa-calculator"></i>
                                    <span>Cashier</span></a>
                            </li>
                        @endif

                        {{-- ----------------------------  manager, admin ----------------------------------------- --}}

                        @if (Auth::user()->role == 2 || Auth::user()->role == 1)
                            <li class="submenu">
                                <a href="#"><i class="fa fa-product-hunt"></i> <span> Products </span>
                                    <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="{{ route('product.index') }}">Products List</a></li>
                                    <li><a href="{{ route('barcode.create') }}"><i class="fa fa-barcode"></i> Barcodes</a></li>
                                    <li><a href="{{ route('category.create') }}">Product Categories</a></li>
                                </ul>
                            </li>
                        @endif
                        {{-- ----------------------------  cashier ----------------------------------------- --}}

                        @if (Auth::user()->role == 3)
                            <li class="submenu">
                                <a href="#"><i class="fa fa-product-hunt"></i> <span> Products </span>
                                    <span class="menu-arrow"></span></a>
                                <ul style="display: none;">
                                    <li><a href="{{ route('product.index') }}">Products List</a></li>
                                </ul>
                            </li>
                        @endif

                        <li>
                            <a href="{{route('order.index')}}"><i class="fa fa-shopping-cart"></i> <span>Orders
                                </span></a>
                        </li>

                        <li class="submenu">
                            <a href=""><i class="fa fa-credit-card"></i> <span> Transactions </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="{{route('transactions.index')}}">View </a></li>
                                <li><a href="#"> Payslip </a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-shopping-bag"></i> <span>Purchases</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-user"></i> <span> Employees </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="#">Employees List</a></li>
                                <li><a href="#">Leaves</a></li>
                                <li><a href="#">Holidays</a></li>
                                <li><a href="#">Attendance</a></li>
                            </ul>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-money"></i> <span> Accounts </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="#">Invoices</a></li>
                                <li><a href="#">Payments</a></li>
                                <li><a href="#">Expenses</a></li>
                                <li><a href="#">Taxes</a></li>
                                <li><a href="#">Provident Fund</a></li>
                            </ul>
                        </li>


                        {{-- <li class="submenu">
                            <a href="#"><i class="fa fa-video-camera camera"></i> <span> Customers</span> <span


                        </li> --}}

                        <li class="submenu">
                            <a href="#"><i class="fa fa-flag-o"></i> <span> Reports </span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="#"> Expense Report </a></li>
                                <li><a href="#"> Invoice Report </a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-cog"></i> <span>Settings</span></a>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-envelope"></i> <span> Email</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="#">Compose Mail</a></li>
                                <li><a href="#">Inbox</a></li>
                                <li><a href="#">Mail View</a></li>
                            </ul>
                        </li>
{{--
                        <li class="menu-title">Extras</li>
                        <li class="submenu">
                            <a href="#"><i class="fa fa-columns"></i> <span>Pages</span> <span
                                    class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="login.html"> Login </a></li>
                                <li><a href="register.html"> Register </a></li>
                                <li><a href="forgot-password.html"> Forgot Password </a></li>
                                <li><a href="change-password2.html"> Change Password </a></li>
                                <li><a href="lock-screen.html"> Lock Screen </a></li>
                                <li><a href="profile.html"> Profile </a></li>
                                <li><a href="gallery.html"> Gallery </a></li>
                                <li><a href="error-404.html">404 Error </a></li>
                                <li><a href="error-500.html">500 Error </a></li>
                                <li><a href="blank-page.html"> Blank Page </a></li>
                            </ul>
                        </li> --}}

                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('/js/select2.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>


    <script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>

    <script src="{{ asset('/js/moment.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
  </script>
    @yield('scripts')






</body>

</html>
