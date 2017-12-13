@extends('layouts.font-end2')

@section('content')
    <!-- ========================== Inner Banner =================== -->
    <section class="inner_banner">
        <div class="container">
            <div class="banner-title">
                <h1>User Password Reset</h1>
                <span class="decor-equal"></span>
            </div>
        </div>
    </section>
    <!-- ========================== /Inner Banner =================== -->

    <section class="login_page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-lg-offset-3 col-md-offset-3 col-xs-12">
                    <div class="title_container">
                        <h4>Password Reset</h4>
                        <span class="decor_default"></span>
                    </div>

                    @if (session()->has('message'))
                        <div style="margin-top: 20px;margin-bottom: -10px;" class="alert alert-danger alert-dismissable">
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
                    <form action="{{ route('password.request') }}" method="post" accept-charset="utf-8" class="block">
                        {!! csrf_field() !!}

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group">
                            <input type="email" name="email" value="{{ old('email') }}" required class="form-control" placeholder="Enter Mail id *" aria-describedby="basic-addon3">
                            <span class="input-group-addon" id="basic-addon3"><i class="fa fa-envelope-o"></i></span>
                        </div>

                        <div class="input-group">
                            <input type="password" name="password" autocomplete="new-password" required class="form-control" placeholder="Enter Password" aria-describedby="basic-addon4">
                            <span class="input-group-addon" id="basic-addon4"><i class="fa fa-unlock-alt"></i></span>
                        </div>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" autocomplete="new-password" required class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon4">
                            <span class="input-group-addon" id="basic-addon4"><i class="fa fa-unlock-alt"></i></span>
                        </div>

                        <div class="login_option clear_fix">
                            <div style="width: 100%" class="submit_button flt_left">
                                <button style="width: 100%" type="submit" class="transition3s hvr-sweep-to-rightB"><i class="fa fa-send"></i> Reset Password</button>
                            </div> <!-- /submit_button -->
                            <div class="clear_fix"></div>
                        </div> <!-- /login_option -->
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection
