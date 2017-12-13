@extends('layouts.font-end2')
@section('style')

    <link rel="stylesheet" href="{{ asset('assets/css/venobox.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style1.css') }}"> {{--Edit --}}
    <link rel="stylesheet" href="{{ asset('assets/css/ion.rangeSlider.skinFlat.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages.css') }}">

@endsection
@section('content')


    <!-- ==================== Banner ===================== -->
    <section class="banner">
        <div class="rev_slider_wrapper">
            <div id="main_slider" class="rev_slider"  data-version="5.0">
                <ul>

                    @foreach($slider as $s)
                        @if($s->id % 2)
                            <li data-transition="fade" class="slide_show"> <!-- Slide_show -->
                                <img src="{{ asset('assets/images') }}/{{ $s->image }}" alt="image">
                                <div class="main_heading tp-caption tp-resizeme title_container"
                                     data-x="['left','left','left','left']" data-hoffset="['0','80','80','0']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['-153','-163','-183','-173']"
                                     data-whitespace="nowrap"
                                     data-transform_idle="o:1;"
                                     data-transform_in="x:-50px;opacity:0;s:2000;e:Power3.easeOut;"
                                     data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                     data-start="1300"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-responsive_offset="on">
                                    <h6>{{ $s->title }}</h6>
                                    <span class="decor_default" style="margin-top:19px;"></span>
                                </div>
                                <div class="tp-caption tp-resizeme"
                                     data-x="['left','left','left','left']" data-hoffset="['0','80','80','0']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['-51','-53','-63','-75']"
                                     data-transform_idle="o:1;"
                                     data-whitespace="nowrap"
                                     data-transform_in="x:50px;opacity:0;s:1000;e:Power3.easeOut;"
                                     data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                     data-start="1500">
                                    <h1>{{ substr($s->description,0,10) }}<br>{{ substr($s->description,10,20) }}<br>{{ substr($s->description,20,30) }}</h1>
                                </div>
                            </li> <!-- /Slide_show -->

                        @else

                            <li data-transition="slideright" class="slide_show slide_3"> <!-- Slide_3 -->
                                <img src="{{ asset('assets/images') }}/{{ $s->image }}" alt="image">
                                <div class="main_heading tp-caption tp-resizeme title_container"
                                     data-x="['right','right','right','right']" data-hoffset="['250','335','335','174']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['-150','-150','-160','-150']"
                                     data-transform_idle="o:1;"
                                     data-transform_in="x:-50px;opacity:0;s:2000;e:Power3.easeOut;"
                                     data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                     data-whitespace="nowrap"
                                     data-start="1300"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-responsive_offset="on">
                                    <h6>{{ $s->title }}</h6>
                                    <span class="decor_default" style="margin-top:19px;"></span>
                                </div>
                                <div class="tp-caption tp-resizeme"
                                     data-x="['right','right','right','right']" data-hoffset="['0','85','85','44']"
                                     data-y="['middle','middle','middle','middle']" data-voffset="['-50','-50','-60','-50']"
                                     data-transform_idle="o:1;"
                                     data-transform_in="x:50px;opacity:0;s:1000;e:Power3.easeOut;"
                                     data-transform_out="s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;"
                                     data-whitespace="nowrap"
                                     data-start="1400"
                                     data-splitin="none"
                                     data-splitout="none"
                                     data-responsive_offset="on">
                                    <h1>{{ substr($s->description,0,15) }}</h1>
                                </div>
                            </li> <!-- /Slide_3 -->
                        @endif
                    @endforeach

                </ul>
            </div>
        </div>
    </section>
    <!-- =============== /Banner ================ -->

    <!-- ================== welcome finance press ================= -->
    <section class="about_finance_press">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 finance_text">
                    <div class="title_container">
                        <h4>About {{ $site_title }}</h4>
                        <span class="decor_default"></span>
                    </div>
                    <div style="margin-left: 0;" class="some_speach">
                        <p style="text-align: justify">{!! $general->about_text !!} </p>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    @foreach($promo as $p)
                        <div class="finance_fact_item row">
                            <div class="icon_holder col-lg-2 col-md-2 col-sm-3 col-xs-2">
                                <span style="font-size: 55px;color: #{{ $general->color }}" class="icon">{!! $p->icon !!}</span>
                            </div>
                            <div class="finance_fact_name col-lg-7 col-md-7 col-sm-7 col-xs-6">
                                <h6>{{ $p->title }}</h6>
                                <span>{{ $p->s_text }}</span>
                            </div>
                            <span class="col-lg-3 col-md-3 col-sm-2 col-xs-4 counter timer" data-from="0" data-to="{{ $p->number }}" data-speed="5000" data-refresh-interval="50"></span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- ================== /welcome finance press ================= -->

    <!-- ===================== testimonial & people choose us ============= -->
    <section class="section_bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 testimonial">
                    <div class="img_holder">
                        <img src="{{ asset('assets/images/test-bg.jpg') }}" alt="images">
                        <div class="overlay"></div>
                    </div>
                    <div class="slider_container">
                        <div id="testimonial-slider" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner inner_slider_container" role="listbox">
                                @foreach($testimonial as $t)
                                    <div class="item {{ $t->id == 1 ? 'active' : "" }}">
                                        <span class="icon flaticon-quotes3"></span>
                                        <p class="speach">{{ $t->description }}</p>
                                        <div class="client_name">
                                            <h6>{{ $t->name }}</h6>
                                            <span>{{ $t->position }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div> <!-- end inner_slider_container -->
                        </div> <!-- end #testimonial-slider -->
                    </div> <!-- end slider_container -->
                </div>
                <div class="col-lg-5 col-lg-offset-1 col-md-6 col-sm-12 col-xs-12 people_choose_us">
                    <div class="title_container">
                        <h4>Why People Choose Us</h4>
                        <span class="decor_default"></span>
                    </div>
                    @foreach($chose as $c)
                        <div class="row choose_category"> <!-- item1 -->
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 icon-holder">
                                <span style="font-size: 40px;">{!! $c->icon !!}</span>
                            </div>
                            <div class="col-lg-10 col-md-10 col-sm-10 col-xs-8 text_holder">
                                <h5>{{ $c->title }}</h5>
                                <p>{{ $c->s_text }}</p>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- end people_choose_us -->
            </div> <!-- end row -->
        </div> <!-- End container -->
    </section>

    <!-- ===================== /testimonial & people choose us ============= -->

    <section style="margin-top: 0;" class="page page--investing">

        <h1 class="page__title">How to Invest</h1>

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="invest-step">
                        <div class="invest-step__ico">
                            <img src="{{ asset('assets/images/step_reg.svg') }}" alt="" width="70px">
                        </div>
                        <h3 class="invest-step__title">1. Registration</h3>
                        <p class="text">Free registration. To open an account, it's sufficient to enter your e-mail. and phone
                        </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="invest-step">
                        <div class="invest-step__ico">
                            <img src="{{ asset('assets/images/step_invest.svg') }}" alt="" width="70px">
                        </div>
                        <h3 class="invest-step__title">2. Investing</h3>
                        <p class="text">Transfer of investment funds in trust to our traders </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="invest-step">
                        <div class="invest-step__ico">
                            <img src="{{ asset('assets/images/step_trade.svg') }}" alt="" width="70px">
                        </div>
                        <h3 class="invest-step__title">3. Trading</h3>
                        <p class="text">Trading on the cryptocurrency exchanges and daily accrual of interest </p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="invest-step invest-step--last">
                        <div class="invest-step__ico">
                            <img src="{{ asset('assets/images/step_profit.svg') }}" alt="" width="70px">
                        </div>
                        <h3 class="invest-step__title">4. Profit</h3>
                        <p class="text">Equal division of final profit between the company and its investors.</p>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <section class="invest-types">
        <div class="container text-center">
            <h2 class="page__title page__title--3 text-center page__title--plans"><span class="c-blue">Investment Plan</span></h2>
            <div class="row">
                @foreach($plan as $p)
                    <div class="col-md-4 ">
                        <div class="invest-type">
                            <img src="{{ asset('assets/images') }}/{{ $p->image }}" alt="" width="223">
                            <div class="invest-type__line row">
                                <div class="col-xs-4">
                                    <b>{{ $p->percent }}%</b><br>
                                    <span>Percentage</span>
                                </div>
                                <div class="col-xs-4">
                                    <b>{{ $p->time }} - <small>ts</small></b><br>
                                    <span>Rebeat Time</span>
                                </div>
                                <div class="col-xs-4">
                                    <b>{{ $p->compound->name }}</b><br>
                                    <span>Compound</span>
                                </div>
                            </div>
                            {!! Form::open(['route'=>'auto-deposit','method'=>'get']) !!}
                            <div class="invest-type__profit plan__value--{{ $p->id }}">
                                <input type="text" value="{{ $basic->symbol }}{{ ($p->minimum + $p->maximum) / 2 }}" class="invest-type__profit--val" data-slider=".slider-input--{{ $p->id }}"></div>
                            <input type="hidden" name="amount" value="{{ ($p->minimum + $p->maximum) / 2 }}" class="slider-input slider-input--{{ $p->id }}" data-perday="{{ $p->percent }}" data-peryear="{{ $p->time }}" data-min="{{ $p->minimum }}" data-max="{{ $p->maximum }}" data-dailyprofit=".daily-profit-{{ $p->id }}" data-totalprofit=".total-profit-{{ $p->id }} " data-valuetag=".plan__value--{{ $p->id }} .invest-type__profit--val"/>
                            <input type="hidden" name="plan_id" value="{{ $p->id }}">
                            <div class="row">
                                <div class="col-xs-6 invest-type__calc invest-type__calc--daily">
                                    <span>Per Rebeat</span>
                                    <b class="daily-profit-{{ $p->id }}">{{ $basic->symbol }}{{ (($p->minimum + $p->maximum) / 2 ) * $p->percent /100 }}.0</b>
                                </div>
                                <div class="col-xs-6 invest-type__calc invest-type__calc--total">
                                    <span>Total Return</span>
                                    <b class="total-profit-{{ $p->id }}">{{ $basic->symbol }}{{ (((($p->minimum + $p->maximum) / 2) * $p->percent) /100 ) * $p->time }}.0</b>
                                </div>
                            </div>
                            <button type="submit" class="btn btn--big btn--red">Choose Plan</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- =========================== Latest News ============================= -->
    <section class="latest_news">
        <div class="container">
            <div class="row">

                @foreach($news as $n)

                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <div class="single_news">

                            <div class="img_holder">
                                <img class="img-responsive" src="{{ asset('assets/images') }}/{{ $n->image }}" alt="images">
                                <div class="hvr-sweep-to-bottom"></div>
                                <div class="icon_holder transition3s">
                                    <a href="{{ route('news-details',['id'=>$n->id,'slug'=>str_slug($n->title)]) }}"><i class="fa fa-link"></i></a>
                                </div>
                            </div>
                            <div class="post_meta">
                                <ul>
                                    <li><a href="#"><i class="fa fa-bars"></i> Posted On {{ $n->category->name }}</a></li>
                                    <li><a href="#"><i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($n->created_at)->format('d F Y') }}</a></li>
                                </ul>
                                <div class="title_container">
                                    <h3>{{ $n->title }}</h3>
                                    <span class="decor_default"></span>
                                </div>
                                <p>
                                    {!! substr(strip_tags($n->description),0,280) !!}{{ strlen(strip_tags($n->description)) > 280 ? "..." : "" }}
                                </p>
                                <a href="{{ route('news-details',['id'=>$n->id,'slug'=>str_slug($n->title)]) }}" target="_blank" class="read_more transition3s">Read More <i class="fa fa-caret-right"></i></a>
                            </div>
                        </div> <!-- End single news -->
                    </div>
                @endforeach

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="news_aside">
                        @foreach($news_rand as $r)
                            <a href="{{ route('news-details',['id'=>$r->id,'slug'=>str_slug($r->title)]) }}">
                                <div class="aside_item">
                                    <div class="overlay"></div>
                                    <div class="text">
                                        <h3>{{ $r->category->name }}</h3>
                                        <span>{{ $r->title }}</span>
                                    </div>
                                </div> <!-- /aside_item -->
                            </a>
                        @endforeach
                    </div> <!-- /news_aside -->
                </div>
            </div>
        </div>
    </section>
    <!-- =========================== Latest News ============================= -->


    <!--  ============================ Our partners =================== -->
    <div class="our_partners">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div >
                        <ul id="owl-demo2">
                            @foreach($partner as $p)
                                <li class="item"><a href="#"><img src="{{ asset('assets/images') }}/{{ $p->image }}" alt="logo"></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  ============================ /Our partners =================== -->


@endsection
@section('scripts')

    <script type="text/javascript" src="{{ asset('assets/js/venobox.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/ion.rangeSlider.js') }}"></script>

    <script>
        $.each($('.slider-input'), function() {
            var $t = $(this),

                    from = $t.data('from'),
                    to = $t.data('to'),

                    $dailyProfit = $($t.data('dailyprofit')),
                    $totalProfit = $($t.data('totalprofit')),

                    $val = $($t.data('valuetag')),

                    perDay = $t.data('perday'),
                    perYear = $t.data('peryear');


            $t.ionRangeSlider({
                input_values_separator: ";",
                prefix: '{{ $basic->symbol }}',
                hide_min_max: true,
                force_edges: true,
                onChange: function(val) {
                    $val.val( '{{ $basic->symbol }}' + val.from);

                    var profit = (val.from * perDay / 100).toFixed(1);
                    profit  = '{{ $basic->symbol }}' + profit.replace('.', '.') ;
                    $dailyProfit.text(profit) ;

                    profit = ( (val.from * perDay / 100)* perYear ).toFixed(1);
                    profit  =  '{{ $basic->symbol }}' + profit.replace('.', '.');
                    $totalProfit.text(profit);

                }
            });
        });
        $('.invest-type__profit--val').on('change', function(e) {

            var slider = $($(this).data('slider')).data("ionRangeSlider");

            slider.update({
                from: $(this).val().replace('{{ $basic->symbol }}', "")
            });
        })
    </script>

@endsection