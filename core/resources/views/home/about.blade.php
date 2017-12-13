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

    <section class="our_mission">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mission_value pull-right">
                    {!! $page->$tt !!}
                </div>
            </div>
        </div>
    </section>


@endsection
