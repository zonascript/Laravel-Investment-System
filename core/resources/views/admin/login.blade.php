<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">

    <title>Admin | Login</title>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/jquery-ui-1.10.3.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/font-icons/entypo/css/entypo.css') }}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/neon-core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/neon-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/neon-forms.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom.css') }}">

    <script src="{{ asset('assets/dashboard/js/jquery-1.11.3.min.js') }}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body login-page login-form-fall">


<!-- This is needed when you send requests via Ajax -->
<script type="text/javascript">
    var baseurl = '';
</script>

<div class="login-container">

    <div class="login-header login-caret">

        <div class="login-content">

            <a href="" class="logo">
                <img src="{{ asset('assets/images/logo.png') }}" width="120" alt="" />
            </a>

            <p class="description">Dear user, log in to access the admin area!</p>


        </div>

    </div>

    <div class="login-progressbar">
        <div></div>
    </div>

    <div class="login-form">

        <div class="login-content">


                @if (session()->has('message'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if($errors->any())
                    @foreach ($errors->all() as $error)

                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {!!  $error !!}
                        </div>
                    @endforeach
                @endif

            <form class="form-horizontal" method="POST" role="form" action="{{ route('admin.login.post') }}" >

            {{ csrf_field() }}
                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-user"></i>
                        </div>

                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Enter User Name" required autofocus >

                    </div>
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Enter Password" required>
                        {{--<input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />--}}
                    </div>

                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-login"></i>
                        Log In
                    </button>
                </div>

                <!-- Implemented in v1.1.4 -->
                <div class="form-group">
                    <em>- or -</em>
                </div>

                <div class="form-group">

                    <a style="color: #f0f0f0" href="{{ route('admin.password.request') }}" class="link btn btn-danger btn-lg btn-block btn-icon icon-left">
                        Forgot your password?
                        <i class="entypo-lock-open"></i>
                    </a>

                </div>

            </form>


        </div>

    </div>

</div>


<!-- Bottom scripts (common) -->
<script src="{{ asset('assets/dashboard/js/TweenMax.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/joinable.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/resizeable.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/neon-api.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/neon-login.js') }}"></script>


<!-- JavaScripts initializations and stuff -->
<script src="{{ asset('assets/dashboard/js/neon-custom.js') }}"></script>


<!-- Demo Settings -->
<script src="{{ asset('assets/dashboard/js/neon-demo.js') }}"></script>

</body>
</html>
