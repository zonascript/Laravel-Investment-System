@extends('layouts.font-end2')

@section('content')
    <!-- ========================== Inner Banner =================== -->
    <section class="inner_banner">
        <div class="container">
            <div class="banner-title">
                <h1>User Login Page</h1>
                <span class="decor-equal"></span>
            </div>
        </div>
    </section>
    <!-- ========================== /Inner Banner =================== -->

    <section class="login_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-lg-offset-3 col-md-offset-3 col-xs-12">
                   
                    @if (session()->has('message'))
                        <div style="margin-top: 20px;margin-bottom: -10px;" class="alert alert-success alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if (session()->has('status'))
                        <div style="margin-top: 20px;margin-bottom: -10px;" class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ session()->get('status') }}
                        </div>
                    @endif

                    @if($errors->any())

                        @foreach ($errors->all() as $error)

                            <div style="margin-top: 20px;margin-bottom: -20px;" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {!!  $error !!}
                            </div>

                        @endforeach
                    @endif
                    <form action="{{ route('login') }}" method="post" accept-charset="utf-8" class="block">
                        {!! csrf_field() !!}

                        <div class="input-group">
                            <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="Enter Email Address" aria-describedby="basic-addon3">
                            <span class="input-group-addon" id="basic-addon3"><i class="fa fa-envelope-o"></i></span>
                        </div>

                        <div class="input-group">
                            <input type="password" name="password" autocomplete="new-password" required class="form-control" placeholder="Enter Password" aria-describedby="basic-addon4">
                            <span class="input-group-addon" id="basic-addon4"><i class="fa fa-unlock-alt"></i></span>
                        </div>
                        <div class="login_option clear_fix">
                            <div class="submit_button flt_left">
                                <button type="submit" class="transition3s hvr-sweep-to-rightB"><i class="fa fa-send"></i> Login</button>
                                <div class="input-group">
								  <span class="input-group-addon">
							        <input type="checkbox" aria-label="..." {{ old('remember') ? 'checked' : '' }}>
							      </span>
                                    <p>Remember Me</p>
                                </div>
                            </div> <!-- /submit_button -->
                            <div class="social_icon flt_right">
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div> <!-- /social_icon -->
                            <div class="clear_fix"></div>
                        </div> <!-- /login_option -->
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
