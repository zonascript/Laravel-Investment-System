@extends('layouts.font-end2')
@section('content')



    <!-- ========================== Inner Banner =================== -->
    <section class="inner_banner">
        <div class="container">
            <div class="banner-title">
                <h1>{{ $page_title }}</h1>
                <span class="decor-equal"></span>
            </div>
        </div>
    </section>
    <!-- ========================== /Inner Banner =================== -->

    <!-- ======================= Breadcrumb ========================== -->
    <section class="breadcrumb_sec">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-5">
                    <h5>{{ $page_title }}</h5>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-7">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li class="dot"></li>
                        <li>{{ $page_title }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- ======================= /Breadcrumb ========================== -->



    <!-- =========================== Contact container ================== -->
    <section class="contact_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 contact_text">
                    <div class="title_container">
                        <h4>Short Details About US</h4>
                        <span class="decor_default"></span>
                    </div>
                    <p style="text-align: justify">{!! $general->about_text  !!} </p>
                    <div class="meet_office">
                        <h4>Meet With Us:</h4>
                        <div style="width: 50%" class="address contact_information">
                            <h5>Address :</h5>
                            <p>{{ $general->address }}</p>
                        </div> <!-- /address -->
                        <div class="mail contact_information">
                            <h5>Mail Us</h5>
                            <a href="mailto:{{ $general->email }}">{{ $general->email }}</a>
                        </div> <!-- /mail -->
                        <div class="clear_fix"></div>
                    </div> <!-- /meet_office -->
                </div> <!-- /contact_text -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 lets_talk_to_us">
                    <div class="title_container">
                        <h4>Let’s Talk To Us</h4>
                        <span class="decor_default"></span>
                    </div>
                    {{ Form::open() }}
                    <div class="row">
                        <div class="col-md-12">
                            @if (session()->has('message'))
                                <div style="margin-bottom: 20px;margin-top: 20px;" class="alert alert-success alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                        <label>Your Name (Required)</label>
                        <div class="input-group">
                            <input type="text" name="name" placeholder="Name *" required class="form-control" aria-describedby="basic-addon2">
                            <span class="input-group-addon" id="basic-addon2"><i class="fa fa-user"></i></span>
                        </div>

                        <label>Email (Required)</label>
                        <div class="input-group">
                            <input type="email" name="email" placeholder="Email *" required class="form-control" aria-describedby="basic-addon3">
                            <span class="input-group-addon" id="basic-addon3"><i class="fa fa-envelope"></i></span>
                        </div>
                        <label>Subject (Required)</label>
                        <div class="input-group">
                            <input type="text" name="subject" placeholder="Subject *" required class="form-control" aria-describedby="basic-addon3">
                            <span class="input-group-addon" id="basic-addon3"><i class="fa fa-bars"></i></span>
                        </div>
                        <label>Tell Us More</label>
                        <div class="input-group input_group_textarea">
                            <textarea name="message" placeholder="Message *" required aria-describedby="basic-addon4"></textarea>
                            <span class="input-group-addon" id="basic-addon4"><i class="fa fa-comments"></i></span>
                        </div>
                        <button style="margin-bottom:40px;width: 100%" type="submit" class="button-main hvr-sweep-to-rightB submit_now">Send now</button>
                    {!! Form::close() !!}
                </div> <!-- /lets_talk_to_us -->
            </div> <!-- /row -->
        </div> <!-- /container -->
    </section> <!-- /contact_container -->

    <!-- =========================== Contact container ================== -->


@endsection




{{--
@extends('layouts.home')
@section('content')


    <section class="page page--contact-us">
        <div class="equlizer-block equlizer-block--title">
            <span class=" equlizer equlizer--1"></span>
            <span class="equlizer equlizer--2"></span>
            <span class="equlizer equlizer--3"></span>
            <span class="equlizer equlizer--4"></span>
            <span class="equlizer equlizer--5"></span>
            <span class=" equlizer equlizer--1"></span>
            <span class="equlizer equlizer--2"></span>
        </div>
        <h1 class="page__title">Contact Us</h1>
        <ul class="breadcrumbs">
            <li class="breadcrumb">
                <a href="{{ route('home') }}" class="breadcrumb__link">Home</a>
            </li>
            <li class="breadcrumb">
                <a href="" class="breadcrumb__link">Contact Us</a>
            </li>
        </ul>

        <div class="nav-top__soc text-center">
            <a href="{{ $general->facebook }}" class="soc-top__link soc-top__link--fb"></a>
            <a href="#" class="soc-top__link soc-top__link--vk"></a>
            <a href="#" class="soc-top__link soc-top__link--inst"></a>
            <a href="{{ $general->youtube }}" class="soc-top__link soc-top__link--yt"></a>
            <a href="{{ $general->google_plus }}" class="soc-top__link soc-top__link--gp"></a>
        </div>
    </section>
    <div class="contacts">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6">
                    <div class="address-block address-block--email">
                        <a href="mailto:{{ $general->email }}">{{ $general->email }}</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="address-block address-block--address text text--sm">
                        {{ $general->address }}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div style="margin-top: 0;" class="col-md-offset-1 col-md-10 contact-form">
                    {{ Form::open() }}


                        <h2 class="page__title page__title--3 text-center">Write to us</h2>

                        <div class="row">
                            <div class="col-md-12">
                                @if (session()->has('message'))
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="name" value="" id="contact_name" placeholder="Name" class="input input--block name" required />

                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" value="" id="contact_email" placeholder="Email" class="input input--block email" required  />

                            </div>
                            <div class="col-md-6">
                                <input type="text" name="subject" value="" id="contact_subject" placeholder="Subject" class="input input--block name" required  />

                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone" value="" id="contact_phone" placeholder="phone" class="input input--block email" required  />

                            </div>
                            <div class="col-md-12">
                                <textarea name="message" cols="40" rows="10" id="contact_message" placeholder="Message" class=" form-control message" required ></textarea>

                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-block btn--big" name="contact-submit" value="1">SEND MESSAGE</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>


@endsection--}}
