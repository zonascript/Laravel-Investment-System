<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}">

    <title>Admin | Forget Password</title>

    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/jquery-ui-1.10.3.custom.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/font-icons/entypo/css/entypo.css') }}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/neon-core.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/neon-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/neon-forms.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/custom.css') }}">

    <script src="{{ asset('assets/dashboard/js/jquery-1.11.3.min.js') }}"></script>


    <!--[if lt IE 9]><script src="{{ asset('assets/js/ie8-responsive-file-warning.js') }}"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body login-page login-form-fall" data-url="http://neon.dev">


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

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
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

            {{--<form class="form-horizontal" method="POST" role="form" action="{{ route('admin.password.request') }}" >

                {{ csrf_field() }}

                <div class="form-steps">

                    <div class="step current" id="step-1">

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-login">
                                Reset password
                                <i class="entypo-right-open-mini"></i>
                            </button>
                        </div>

                    </div>

                </div>

            </form>--}}
            <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                        @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Reset Password
                        </button>
                    </div>
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



