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
        .header-top{
            width: 100%;
            height: auto;
            padding: 7px 0px;
            box-sizing: border-box;
            direction: rtl;
            border-bottom: solid 1px #d0d0d0;
        }
        .header-top-logo{
            width: 25%;
            height: auto;
            padding: 8px 0px;
            display: flex;
            flex-direction: column;
        }
        .header-top-logo a{
            font-size: 1.3em;
            font-weight: bold;
            color: #444;
        }
        .header-top-logo a:hover {
        }
        .header-top-logo .logo-text{
            margin-top: 2%;
            font-size: .7em;
            color: #a0a0a0;
        }
        .header-top-logo a span.logo{
            color: #cf234f;
        }
        .header-top-search{
            width: 55%;
            height: auto;
            padding: 8px 0px;
            position: relative;
        }
        .header-top-search .search-part{
            width: 100%;
            height: 60px;
            position: relative;
        }
        .header-top-search .search-part input{
            width: 100%;
            height: 40px;
            border: solid 1px #d0d0d0;
            border-radius: 2.5px;
            padding: 3px 10px;
            font-family: 'yekan', sans-serif;
            font-size: .8em;
            background-color: #f9f9f9;
            color: #5a6268;
            outline: none;
            box-shadow: 0 2px 4px 0 rgba(12,18,28,.12);
        }
        .header-top-search .search-part .search-icon{
            height: 40px;
            position: absolute;
            left: 2%;
            top: 10px;
        }
        .header-top-search .search-part .search-icon #srch-icon{
            font-size: 1.1em;
            color: #cf234f;
            cursor: pointer;
        }
        .header-top-search .search-part .search-icon button{
            border: none;
            background: transparent;
            margin-right: 10px;
            border-right: solid 1px #d0d0d0;
            padding-right: 10px;
        }
        .header-top-search .search-part .search-icon button i{
            font-size: 1.3em;
            color: #a0a0a0;
        }
        .header-top-search .display-search{
            background-color: #e6e6e6;
            width: 100%;
            height: 300px;
            z-index: 100;
            position: absolute;
            padding: 10px;
            border-bottom-left-radius: 2px;
            border-bottom-right-radius: 2px;
        }
        .header-top-user{
            width: 20%;
            height: auto;
            padding: 15px 0px;
        }
        .header-top-user .user-action{
            float: left;
        }
        .header-top-user .user-action .login-item{
            border-left: solid 1px #a0a0a0;
            padding-left:12px;
            font-size: .8em;
            color: #444
        }
        .header-top-user .user-action span{
            padding-right: 7px;
        }
        .header-top-user .user-action span a{
            background-color: #cf234f;
            padding: 4px 10px;
            color: #fff8f8;
            font-size: .8em;
            border-radius: 2px
        }
        .show-header{
            display: flex;
            justify-content: space-between;
        }
        .header-bottom{
            background-color: #f9f9f9;
            width: 100%;
            height: auto;
            box-sizing: border-box;
            direction: rtl;
            padding: 10px 0px;
        }
        .header-bottom .container .show-header .right-nav ul{
            display: flex;
        }
        .header-bottom .container .show-header .right-nav ul li {
            margin-left: 20px ;
        }
        .header-bottom .container .show-header .right-nav ul li a{
            font-size: .85em;
            color: #444;
        }
        .header-bottom .container .show-header .right-nav ul li i{
            font-size: .85em;
            color: #444;
            font-weight: bold;
            margin-top: 2px;
        }
        .header-bottom .container .show-header .right-nav ul li .cat-detail{
            background-color: #fff;
            z-index: 100;
            border-radius: 3px;
            padding: 5px;
            margin-top: 25px;
            position: absolute;
        }
        .header-bottom .container .show-header .right-nav ul li .cat-detail li a{
            font-size: .75em;
        }
        .header-bottom .container .show-header .right-nav ul li a.main-page{
            font-weight: bold;
        }
        .header-bottom .container .show-header .left-nav span{

        }
        .header-bottom .container .show-header .left-nav span a{
            font-size: .85em;
            color: #444;
        }
    </style>
    <!-- //animation-effect -->
</head>

<body>
<!-- header -->
<div class="header">
    <div class="header-top">
        <div class="container">
            <div class="show-header">
                <div class="header-top-logo">
                    <a href="#">
                        <span>مجله آموزشی <span class="logo"> کوتیشن </span></span>
                    </a>
                    <span class="logo-text">
                        یادگیری را به شیوه ای متفاوت تجربه کن
                    </span>
                </div>
                <div class="header-top-search">
                    <div class="search-part">
                        <form action="">
                            <input type="text" placeholder="دنبال چیزی میگردی ؟" class="tol">
                            <div class="search-icon">
                                <i id="srch-icon" class="fa fa-circle-notch fa-spin"></i>
                                <i id="srch-icon" class="fa fa-circle fa-times-circle"></i>
                                <button><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="display-search">

                    </div>
                </div>
                <div class="header-top-user">
                    <div class="user-action">
                        <a class="login-item" href="#">ورود</a>
                        <span>
                            <a href="#">ثبت نام</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="show-header">
                <div class="right-nav">
                    <ul>
                        <li><a href="#" class="main-page">صفحه اصلی</a></li>
                        <li><a href="#">دسته بندی ها</a> <i class="fa fa-angle-down"></i>
                            <ul class="cat-detail">
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

                    </ul>
                </div>
                <div class="left-nav">
                    <span><a href="#">تماس با ما</a></span>
                </div>
            </div>
        </div>
    </div>
</div>