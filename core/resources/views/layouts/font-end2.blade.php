<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <!-- For IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- For Resposive Device -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $site_title }} | {{ $page_title }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images') }}/{{ $general->favicon }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.css') }}" media="screen">


    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Alegreya:400,400italic,700,900,700italic,900italic' rel='stylesheet' type='text/css'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <!-- Flat-icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/flat-icon/flaticon.css') }}">
    <!-- Vendor css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/settings.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/navigation.css') }}">
    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.theme.css') }}">

    <!-- jQuery ui css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/jquery-ui.min.css') }}">

    <!-- ================== Custom Css ==================== -->

    <!-- Main theme Style Sheet  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <link href="{{ asset('assets/css/color.php') }}?color={{ $general->color }}" rel="stylesheet">
    <!-- Responsive file -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">
    @yield('style')
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->
    <style>
        .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus{
            background: none;
        }
    </style>


</head>
<body class="login layout_changer">
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


<!-- =================================== Main body Wrapper =========================== -->

<div class="body_wrapper">


    <!-- pre loader  -->

    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>

    <!-- ====================== Header ===================== -->
    <!-- ================= Top header ============= -->
    <div class="top_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 top_header_left">
                    <a href="mailto:{{ $general->email }}"> <span class="icon flaticon-envelope133"></span> Email Us:&nbsp; {{ $general->email }}</a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 top_header_right pull-right">


                    @if(Auth::check())

                        <div class="dropdown">
                            <button style="padding: 5px 10px;font-size: 17px;font-weight: 600;" class="btn-dropdown dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true">
                                <i class="fa fa-user"></i>  Hi. {{ \Illuminate\Support\Facades\Auth::user()->name }}
                                <i class="fa fa-angle-down"></i>
                            </button>
                            <ul style="min-width: 165px;text-align:left;top: 30px;left: -5px;border-radius: 0px 0px 3px 3px" class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a style="color:#fff" href="{{ route('user-dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                                <li>
                                    <a style="color: #fff" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class=""><i class="fa fa-sign-out right"></i>Log Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a style="margin-bottom: 5px;font-size: 17px;font-weight: 600;" href="{{ route('login') }}" class=""><i class="fa fa-sign-in"></i> Log In</a>
                        &nbsp;&nbsp;&nbsp;<a style="margin-bottom: 5px;font-size: 17px;font-weight: 600;" href="{{ route('register') }}" class=""><i class="fa fa-user-plus"></i> Registration</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="bottom_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12 logo_holder">
                    <a href="{{ route('home') }}"></a>
                </div>
                <div class="col-lg-8 col-md-9 col-sm-12 col-xs-12 pull-right address_container">
                    <div>
                        <div class="icon_holder">
                            <span class="icon flaticon-technology"></span>
                        </div>
                        <div class="text_holder">
                            <p>Phone Call <span>{{ $general->number }}</span></p>
                        </div>
                    </div>
                    <div>
                        <div class="icon_holder">
                            <span class="icon flaticon-envelope133"></span>
                        </div>
                        <div class="text_holder">
                            <p>Mail Us <span>{{ $general->email }}</span></p>
                        </div>
                    </div>
                    <div>
                        <div class="icon_holder">
                            <span class="icon flaticon-placeholder"></span>
                        </div>
                        <div class="text_holder">
                            <p>Address <span>{{ substr($general->address,0,18) }}{{ strlen($general->address) > 20 ? ".." : "" }}</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================= Top header ============= -->
    <!-- ====================== /Header ===================== -->



    <!-- ======================= Menu ======================== -->
    <div class="main_menu menu_fixed fixed">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default col-lg-11 col-md-11 col-sm-11 col-xs-12">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <!-- Collect the nav links and other content for toggling -->
                    <div class="collapse navbar-collapse" id="navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about-us') }}">About Us</a></li>
                            <li class="dropdown_menu"><a href="{{ route('news') }}">News <i class="fa fa-sort-desc"></i></a>
                                <ul class="sub-menu">
                                    @foreach($category as $c)
                                        <li><a href="{{ route('category-news',['id'=>$c->id,'slug'=>str_slug($c->name)]) }}">{{ $c->name }}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            @foreach($menu as $m)
                                <li>
                                    <a href="{{url('menu/')}}/{{$m->id}}/{{urlencode(strtolower($m->name))}}"> {{ $m->name }}
                                    </a>
                                </li>
                            @endforeach
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </nav> <!-- /nav -->


            </div>
        </div>
    </div>
    <!-- ======================= /Menu ======================== -->

@yield('content')
<!-- ========================= Footer ======================= -->
    <footer>
        <div class="container">
            <div class="main_footer">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 footer_logo">
                        <a href="{{ route('home') }}" class="logo"></a>
                        <p style="color: #fff;text-align: justify">{!! $general->about_text !!}</p>
                    </div>


                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 contact_us">
                        <div class="footer_widget_title">
                            <h4>Accept Payment Method</h4>
                            <span class="decor_white"></span>
                        </div>
                        <div class="row">

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 contact_us">
                        <div class="footer_widget_title">
                            <h4>Contact Us</h4>
                            <span class="decor_white"></span>
                        </div>
                        <ul>
                            <li><span>Address :</span>{{ $general->address }}</li>
                            <li><span>Mail Us</span><a href="mailto:{{ $general->email }}" class="transition3s">{{ $general->email }}</a></li>
                            <li><span>Any Enquiries</span><a href="tel:{{ $general->number }}" class="transition3s">{{ $general->number }}</a></li>
                        </ul>
                    </div>
                </div>
            </div> <!-- End main footer -->
            <div class="bottom_footer">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <p>{!! $general->footer_bottom_text !!}</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 left_space_fix pull-right">
                        <a href="{{ route('document') }}" class="transition3s">Document</a>
                        <a style="padding: 0px 20px" href="{{ route('faqs') }}" class="transition3s">FAQS</a>
                        <a href="{{ route('terms') }}" class="transition3s">Terms & Condition</a>
                        <a href="{{ route('privacy') }}" class="transition3s">Privacy & Security</a>
                    </div>
                </div>
            </div> <!-- End bottom footer -->
        </div>
    </footer>
    <!-- ========================= /Footer ======================= -->


    <!-- ======================= Js File ====================== -->

    <!-- j Query -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-2.1.4.js') }}"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- revolution slider js -->
    <script src="{{ asset('assets/js/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.themepunch.revolution.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/revolution.extension.layeranimation.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/revolution.extension.navigation.min.js') }}"></script>
    <!-- owl.carousel js -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- appear js -->
    <script src="{{ asset('assets/js/jquery.appear.js') }}"></script>
    <!-- jQuery ui js -->
    <script type="text/javascript" src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <!-- count to -->
    <script src="{{ asset('assets/js/jquery.countTo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js') }}"></script>

    @yield('scripts')


</div> <!-- End body_wrapper -->
</body>

</html>