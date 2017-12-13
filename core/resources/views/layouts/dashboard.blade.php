<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{{ $site_title }}" />
    <meta name="author" content="" />

    <link rel="icon" href="{{ asset('assets/images') }}/{{ $general->favicon }}">

    <title>{{ $site_title }} | {{ $page_title }}</title>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/jquery-ui-1.10.3.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/font-icons/entypo/css/entypo.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/font-icons/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/neon-core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/neon-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/neon-forms.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/sweetalert.css') }}">

    <script src="{{ asset('assets/dashboard/js/jquery-1.11.3.min.js') }}"></script>

    @yield('style')

    <!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body  page-fade">

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

    <div class="sidebar-menu">

        <div class="sidebar-menu-inner">

            <header class="logo-env">

                <!-- logo -->
                <div class="logo">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" width="120" alt="" />
                    </a>
                </div>

                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>


                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>

            </header>


            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li class="{{ Request::is('dashboard') ? " opened active" : "" }}">
                    <a href="{{ route('dashboard') }}">
                        <i class="entypo-gauge"></i>
                        <span class="title">Dashboard</span>
                    </a>

                </li>

                <li class="{{ Request::is('manual-payment-request') ? " opened active" : "" }}">
                    <a href="{{ route('manual-payment-request') }}">
                        <i class="fa fa-cog"></i>
                        <span class="title">Manage Bank Payment</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <span class="title"><i class="fa fa-reply-all"></i> Manage Withdraw</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('withdraw-pending') }}">
                                <span class="title"><i class="fa fa-spinner"></i> Withdraw Pending</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('withdraw-success') }}">
                                <span class="title"><i class="fa fa-check-circle"></i> Withdraw Success</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('withdraw-refund') }}">
                                <span class="title"><i class="fa fa-exclamation-triangle"></i> Withdraw Refund</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="{{ Request::is('admin-activity') ? " opened active" : "" }}">
                    <a href="{{ route('admin-activity') }}">
                        <i class="fa fa-indent"></i>
                        <span class="title">Activity Log</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin-deposit') ? " opened active" : "" }}">
                    <a href="{{ route('admin-deposit') }}">
                        <i class="fa fa-history"></i>
                        <span class="title">Deposit History</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin-rebeat') ? " opened active" : "" }}">
                    <a href="{{ route('admin-rebeat') }}">
                        <i class="fa fa-money"></i>
                        <span class="title">Add Growth %</span>
                    </a>
                </li>

                <li class="has-sub">
                    <a href="#">
                        <span class="title"><i class="fa fa-users"></i> Manage Users</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('user-manage') }}">
                                <span class="title"><i class="fa fa-users"></i> Manage Users</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('block-user') }}">
                                <span class="title"><i class="fa fa-user-times"></i> Blocked Users</span>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="{{ Request::is('manual-payment') ? " opened active" : "" }}">
                    <a href="{{ route('manual-payment') }}">
                        <i class="fa fa-bank"></i>
                        <span class="title">Manage Bank</span>
                    </a>
                </li>


            <!--<li class="{{ Request::is('withdraw-payment') ? " opened active" : "" }}">
                    <a href="{{ route('withdraw-payment') }}">
                        <i class="fa fa-money"></i>
                        <span class="title">Withdraw Method</span>
                    </a>
                </li>

                <li class="{{ Request::is('news-category') ? " opened active" : "" }}">
                    <a href="{{ route('news-category') }}">
                        <i class="fa fa-list"></i>
                        <span class="title">News Category</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <span class="title"><i class="fa fa-newspaper-o"></i> Manage News</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('news-create') }}">
                                <span class="title"><i class="entypo-plus"></i> Create New News</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('news-show') }}">
                                <span class="title"><i class="entypo-monitor"></i> View All News</span>
                            </a>
                        </li>

                    </ul>
                </li>-->
                <li>
                    <a href="{{ route('latter-create') }}">
                        <span class="title"><i class="fa fa-envelope-open"></i> Send News Latter</span>
                    </a>
                </li>
            <!-- <li class="{{ Request::is('manage-compound') ? " opened active" : "" }}">
                    <a href="{{ route('manage-compound') }}">
                        <i class="fa fa-sort-amount-asc"></i>
                        <span class="title">Manage Compound</span>
                    </a>
                </li>
            <li class="has-sub">
                    <a href="#">
                        <span class="title"><i class="fa fa-handshake-o"></i> Manage Partner</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('partner-create') }}">
                                <span class="title"><i class="entypo-plus"></i> Create New Partner</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('partner-show') }}">
                                <span class="title"><i class="entypo-monitor"></i> View All Partner</span>
                            </a>
                        </li>

                    </ul>
                </li>-->
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-tools"></i>
                        <span class="title">Web Control</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('basic-setting') }}">
                                <span class="title"><i class="entypo-cog"></i> Basic Setting</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('general-setting') }}">
                                <span class="title"><i class="entypo-cog"></i> General Setting</span>
                            </a>
                        </li>
                        <!--<li>
                            <a href="{{ route('manage-chose') }}">
                                <span class="title"><i class="entypo-cog"></i> Manage Chose Us</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-promo') }}">
                                <span class="title"><i class="entypo-cog"></i> Manage Promo</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage-testimonial') }}">
                                <span class="title"><i class="entypo-cog"></i> Manage Testimonial</span>
                            </a>
                        </li>
                        <li class="has-sub">
                            <a href="#">
                                <span class="title"><i class="entypo-cog"></i> Manage Menu</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route('menu_create') }}">
                                        <span class="title"><i class="entypo-plus"></i> Add New</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('menu_show') }}">
                                        <span class="title"><i class="entypo-monitor"></i> View All</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="has-sub">
                            <a href="#">
                                <span class="title"><i class="entypo-cog"></i> Manage Slider</span>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ route('slider-create') }}">
                                        <span class="title"><i class="entypo-plus"></i> Add New</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('slider-show') }}">
                                        <span class="title"><i class="entypo-monitor"></i> View All</span>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="has-sub">
                            <a href="#">
                                <span class="title"><i class="entypo-cog"></i> Manage Web page</span>
                            </a>
                            <ul>

                                <li>
                                    <a href="{{ route('manage-about') }}">
                                        <span class="title"><i class="entypo-cog"></i> Manage About Page</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('manage-faq') }}">
                                        <span class="title"><i class="entypo-cog"></i> Manage FAQ Page</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('manage-document') }}">
                                        <span class="title"><i class="entypo-cog"></i> Manage Document Page</span>
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('manage-terms') }}">
                                        <span class="title"><i class="entypo-cog"></i> Manage Terms & Condition</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('manage-privacy') }}">
                                        <span class="title"><i class="entypo-cog"></i> Manage Privacy page</span>
                                    </a>
                                </li>
                            </ul>
                        </li>-->

                    </ul>
                </li>

            </ul>

        </div>

    </div>

    <div class="main-content">

        <div class="row">

            <div class="col-md-6">
                <h2>{{ $page_title }}</h2>
            </div>

            <!-- Profile Info and Notifications -->
            <div class="col-md-6 col-sm-6 clearfix" style="padding-right: 50px;">

                <ul class="user-info pull-right pull-none-xsm">

                    <!-- Profile Info -->
                    <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->

                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img style="height: 40px" src="{{ asset('assets/images') }}/{{ Auth::guard('admin')->user()->image }}" alt="" class="img-circle" width="44" />
                            {{ Auth::guard('admin')->user()->name }} <i class="fa fa-sort-down"></i>
                        </a>

                        <ul class="dropdown-menu">

                            <!-- Reverse Caret -->
                            <li class="caret"></li>

                            <!-- Profile sub-links -->
                            <li>
                                <a href="{{ route('edit-profile') }}">
                                    <i class="entypo-pencil"></i>Edit Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('change-pass') }}">
                                    <i class="entypo-attention"></i>
                                    Change Password
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.logout') }}">
                                    <i class="entypo-logout right"></i> Log Out
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>


        </div>

        <hr />
        <div class="row">
            <div class="col-md-12">
                <!--  ==================================VALIDATION ERRORS==================================  -->
                @if($errors->any())
                    @foreach ($errors->all() as $error)

                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!!  $error !!}
                        </div>

                @endforeach
            @endif
            <!--  ==================================SESSION MESSAGES==================================  -->
            </div>
        </div>

    @yield('content')


    <!-- Footer -->
        <footer class="main">

            &copy; @php echo date('Y'); @endphp <strong>All Copyright Reserved.</strong>

        </footer>
    </div>


</div>


<!-- Bottom scripts (common) -->
<script src="{{ asset('assets/dashboard/js/TweenMax.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/joinable.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/resizeable.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/neon-api.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/sweetalert.min.js') }}"></script>

<script>
    @if (session()->has('message'))
        swal({
        title: "{!! session()->get('title')  !!}",
        text: "{!! session()->get('message')  !!}",
        type: "{!! session()->get('type')  !!}",
        confirmButtonText: "OK"
    });
    @endif

</script>


@yield('scripts')

<!-- JavaScripts initializations and stuff -->
<script src="{{ asset('assets/dashboard/js/neon-custom.js') }}"></script>


</body>
</html>