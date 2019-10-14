<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>فروشگاه محتوا</title>
    <!-- for-mobile-apps -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Best Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="{{asset('public/css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('public/css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <!-- js -->
    <script src="{{asset('public/js/jquery.min.js')}}"></script>
    <!-- //js -->
    <!-- cart -->
    <script src="{{asset('public/js/simpleCart.min.js')}}"></script>
    <!-- cart -->
    <!-- for bootstrap working -->
    <script type="text/javascript" src="{{asset('public/js/bootstrap-3.1.1.min.js')}}"></script>
    <!-- //for bootstrap working -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <!-- timer -->
    <link rel="stylesheet" href="{{asset('public/css/jquery.countdown.css')}}" />
    <!-- //timer -->
    <!-- animation-effect -->
    <link href="{{asset('public/css/animate.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('public/css/comment/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/video-js.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/video.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset("public/css/fontawesome.min.css")}}">
    <script src="{{asset('public/js/wow.min.js')}}"></script>
    <script>
        new WOW().init();
    </script>
    <style>
        body{
            font-family: 'yekan', sans-serif !important;
        }
    </style>
    <!-- //animation-effect -->
</head>

<body>
<!-- header -->
<div class="header">
    <div class="container">
        <div class="header-grid">
            <div class="header-grid-left animated wow slideInLeft" data-wow-delay=".5s">
                <ul>
                    <li><i class="glyphicon glyphicon-envelope" aria-hidden="true" style="color: #f0004c;"></i>Montazeriput95@gmail.com</li>
                    <li><i class="glyphicon glyphicon-earphone" aria-hidden="true" style="color: #f0004c;"></i>۰۹۱۱۷۱۳۲۲۰۵</li>
                    |
                    <?php
                        if (\Illuminate\Support\Facades\Auth::check()){
                            ?>
                    <li><i class="glyphicon glyphicon-log-in" aria-hidden="true" style="color: #31708f"></i><a href="{{url(route('logout'))}}">خروج</a></li>
                    <li><i class="glyphicon glyphicon-book" aria-hidden="true" style="color: #31708f"></i><a href="register.html">پنل کاربری</a></li>

                <?php
                        }else{
                            ?>
                    <li><i class="glyphicon glyphicon-log-in" aria-hidden="true" style="color: #31708f"></i><a href="{{url(route('UserLogin'))}}">ورود</a></li>
                    <li><i class="glyphicon glyphicon-book" aria-hidden="true" style="color: #31708f"></i><a href="{{url(route('UserRegister'))}}">ثبت نام</a></li>
                <?php
                    }
                    ?>
                   </ul>
                <li><i class="fa fa-circle-notch fa-spin" style="font-size: 1em;color: #cf234f"></i></li>
                <li><i class="fa fa-circle fa-times-circle" style="cursor: pointer;font-size: 1em;color: #cf234f"></i></li>
            </div>
            <div class="header-grid-right animated wow slideInRight" data-wow-delay=".5s">

            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="logo-nav">
            <div class="logo-nav-left animated wow zoomIn" data-wow-delay=".5s">
                <h1><a href="{{url(route('home'))}}">Best Store <span style="color: #f0004c">Shop anywhere</span></a></h1>
            </div>
            <div class="logo-nav-left1" style="display: flex;flex-direction: column">
                <nav class="navbar navbar-default">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header nav_2">
                        <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="{{url(route('home'))}}" class="act" style="font-family: yekan">صفحه اصلی</a></li>
                            <!-- Mega Menu -->
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;font-family: 'yekan', sans-serif">دسته بندی ها <b class="caret"></b></a>
                                <ul class="dropdown-menu multi-column">
                                                <?php
                                                $cats = \App\Category::all();
                                                foreach ($cats as $cat) {
                                                ?>
                                                <li><a style="font-family: 'yekan', sans-serif" href="{{url(route('catIndex',['category'=>$cat->id]))}}">{{$cat->name}}</a></li>
                                                <?php
                                                }
                                                ?>
                                </ul>
                            </li>
                            <li><a style="font-family: yekan" href="{{url(route('contact'))}}">تماس با ما</a></li>
                        </ul>
                    </div>
                </nav>
                <div class="display-search" style="border-radius: 2px;padding:10px;background-color: #f9f9f9;width:600px;height: auto;position:absolute;right:auto;z-index: 100;margin-top: 60px">

                </div>
            </div>

            <div class="logo-nav-right" >
                <div class="search-box">
                    <div id="sb-search" class="sb-search">
                        <form>
                            <input style="direction: rtl" class="sb-search-input tol" placeholder="عبارت مورد نظر خود را از اینجا جستجو کنید ..." type="search" id="search">
                            <input class="sb-search-submit"  type="submit" value="">
                            <span class="sb-icon-search" style="color: #f0004c"> </span>
                        </form>
                    </div>
                </div>
                <!-- search-scripts -->
                <script src="{{asset('public/js/classie.js')}}"></script>
                <script src="{{asset('public/js/uisearch.js')}}"></script>
                <script>
                    new UISearch( document.getElementById( 'sb-search' ) );
                </script>
                <!-- //search-scripts -->
            </div>

            <div class="clearfix"> </div>
        </div>
    </div>
</div>