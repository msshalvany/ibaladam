<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title>ibaladam Admin</title>
    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">
{{--    <link href="/ibaladam/css/bootstrap.css" rel="stylesheet">--}}
    <link href="/admin/css/bootstrap-reset.css" rel="stylesheet">
    <link href="/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="{{ asset('/admin/css/style.css') }}?t={{ time() }}" rel="stylesheet">
    <link href="{{ asset('/ibaladam/css/all.css') }}?t={{ time() }}" rel="stylesheet">
    <link href="{{ asset('/admin/css/style-responsive.css') }}?t={{ time() }}" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css" rel="stylesheet" />
    <script src="/admin/js/jquery.js"></script>
    <script src='{{ asset("/ibaladam/js/function.js") }}?t={{ time() }}'></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <style>
        @yield('css')
    </style>
</head>

<body>
<div class="loead-wait-cin">
    <span class="pers"></span>
    <span>در حال اپلود ....</span>
    <button onclick="location.href=window.location.href" class="btn btn-danger stop-ajsx">کنسل</button>
</div>
    <section id="container" class="">
        <div class="conf-cont">
            <p>ایا از انجام این عملیات مطمعن هستید</p>
            <div>
                <button class="conf-cont-n btn btn-danger">کنسل</button>
                <button class="conf-cont-y btn btn-success">مطمعن</button>
            </div>
        </div>
        <div class="pop-info">
            <div class="pop-info-div"></div>
            <button class="cancel-pop-info btn btn-danger">کنسل</button>
        </div>
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div class="icon-reorder tooltips"></div>
            </div>
            <div class="top-nav">
                <ul class="nav pull-right top-menu">
                    <li class="dropdown" style="margin: 14px 0 0 0;">
                        <a href="{{ route('logoutAdmin') }}"><i class="icon-key"></i> خروج</a>
                    </li>
                </ul>
            </div>
        </header>
        <aside>
            <div id="sidebar" class="nav-collapse ">
                <!-- sidebar menu start-->
                <ul class="sidebar-menu">
                    <li class="">
                        <a class="" href="{{ route('dashbord') }}">
                            <i class="icon-dashboard"></i>
                            <span>داشبورد</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a class="" href="#">
                            <i class="icon-align-center"></i>
                            <span>اتاق</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li><a class="" href="{{ route('door') }}">پذیرش اتاق</a></li>
                            <li><a class="" href="{{ route('doorList') }}">لیست اتاق ها</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="{{ route('grop.index') }}" class="">
                            <i class="icon-list-alt"></i>
                            <span>دسته بندی </span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="{{ route('userShow') }}" class="">
                            <i class="icon-user"></i>
                            <span>کاربران</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="#" class="">
                            <i class="icon-suitcase"></i>
                            <span>ادمین ها</span>
                            <span class="arrow"></span>
                        </a>
                        <ul class="sub">
                            <li><a class="" href="{{ route('admins.index') }}">لیست ادمین ها</a></li>
                            <li><a class="" href="{{ route('admins.create') }}">اضافه کردن ادمین</a></li>
                        </ul>
                    </li>
                    <li class="sub-menu">
                        <a href="{{ route('infoSite') }}" class="">
                            <i class="icon-info"></i>
                            <span>اطلاعات وب سایت</span>
                        </a>
                    </li>
                    <li class="sub-menu">
                        <a href="{{ route('rejectWord') }}" class="">
                            <i class="icon-bookmark"></i>
                            <span>هرزنامه و کلمات حساس</span>
                        </a>
                    </li><li class="sub-menu">
                        <a href="{{ route('ticketList') }}" class="">
                            <i class="icon-bookmark"></i>
                            <span>تیکت ها</span>
                        </a>
                    </li>
                </ul>
            </div>
        </aside>
        <section id="main-content">
            <section class="wrapper">
                @yield('content')
            </section>
        </section>
    </section>
</body>

</html>
<script type="text/javascript" src="{{ asset('/admin/js/script.js') }}?t={{ time() }}"></script>
@yield('js')
