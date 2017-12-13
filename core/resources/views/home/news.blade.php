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
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-3">
                    <h5>{{ $page_title }}</h5>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-9" style="text-align:right;">
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


    <!-- =========================== News container =================== -->
    <div class="news_content_container">
        <div class="container">
            <div class="row">
                <article class="col-lg-9 col-md-8 col-sm-12 col-xs-12 news_post">

                    @foreach($news as $n)

                    <div class="single_news_post">
                        <div class="img_container">
                            <a href="{{ route('news-details',['id'=>$n->id,'slug'=>str_slug($n->title)]) }}">
                            <img class="img-responsive" src="{{ asset('assets/images') }}/{{ $n->image }}" alt="images">
                                </a>
                        </div> <!-- /img_container -->
                        <div class="post_holder">
                            <div class="post_heading">
                                <ul>
                                    <li><i class="fa fa-bars"></i><a href="#">Posted On {{ $n->category->name }}</a></li>
                                    <li>|</li>
                                    <li><i class="fa fa-calendar"></i><a href="#">{{ \Carbon\Carbon::parse($n->created_at)->format('d F Y') }} </a></li>
                                </ul>
                                <div class="title_container">
                                    <a href="{{ route('news-details',['id'=>$n->id,'slug'=>str_slug($n->title)]) }}">
                                    <h4>{{ $n->title }}</h4></a>
                                    <span class="decor_default"></span>
                                </div>
                            </div>  <!-- /post_heading -->
                            <p class="article">{{ substr(strip_tags($n->description),0,380) }}{{ strlen(strip_tags($n->description)) > 380 ? "..." : "" }}</p>
                        </div> <!-- /post_holder -->
                        <div class="share_read">
                            <ul class="share">
                                <li><a class="hvr-sweep-to-right" href="#"><i class="fa fa-eye"></i> View @php $gr = \App\News::findOrFail($n->id) @endphp {{ $gr->view }}</a></li>
                                <li><a class="hvr-sweep-to-right" href="#"><i class="fa fa-share"></i>Share</a></li>
                            </ul>
                            <div class="share_item">
                                <ul>
                                    <li><a target="_blank" href="http://www.facebook.com/share.php?u={{ url()->current() }}/{{ $n->id }}/{{ str_slug($n->title) }}&title={{ $n->title }}" class="hvr-sweep-to-right transition3s"><i class="fa fa-facebook"></i></a></li>
                                    <li><a target="_blank" href="http://twitter.com/home?status={{ $n->title }}+{{ url()->current() }}/{{ $n->id }}/{{ str_slug($n->title) }}" class="hvr-sweep-to-right transition3s"><i class="fa fa-twitter"></i></a></li>
                                    <li><a target="_blank" href="https://plus.google.com/share?url={{ url()->current() }}/{{ $n->id }}/{{ str_slug($n->title) }}" class="hvr-sweep-to-right transition3s"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div><!-- /share -->
                            <a href="{{ route('news-details',['id'=>$n->id,'slug'=>str_slug($n->title)]) }}" class="read_more transition3s flt_right">Read More <i class="fa fa-caret-right"></i></a>
                            <div class="clear_fix"></div>
                        </div> <!-- /share_read -->
                    </div> <!-- /single_news_post -->

                    @endforeach

                    <div style="text-align:center;">
                        {!! $news->links() !!}
                    </div> <!-- /pagination_menu -->
                </article> <!-- /news_post -->

                <!-- ====================== Blog aside ==================== -->

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 blog_aside">

                    <div class="blog_feeds">
                        <div class="title_container">
                            <h4>News</h4>
                            <span class="decor_default"></span>
                        </div>

                        <div class="single_feeds clear_fix"> <!-- single_feeds -->
                            @foreach($news_rand as $nr)
                            <div class="img_holder">
                                <img style="width: 70px;height: 70px" src="{{ asset('assets/images') }}/{{ $nr->image }}" alt="images">
                            </div> <!--  /img_holder -->
                            <div class="text_holder">
                                <a href="{{ route('news-details',['id'=>$nr->id,'slug'=>str_slug($nr->title)]) }}">
                                <h5>{{ substr($nr->title,0,38) }}{{ strlen($nr->title) > 38 ? "..." : '' }}</h5></a>
                                <ul>
                                    <li><i class="fa fa-user"></i>{{ $nr->category->name }}</li>
                                    <li>|</li>
                                    <li><i class="fa fa-calendar"></i>{{ \Carbon\Carbon::parse($nr->created_at)->format('d M y') }}</li>
                                </ul>
                            </div> <!-- /text_holder -->
                            @endforeach
                        </div> <!-- /single_feeds -->

                    </div> <!-- /blog_feeds -->
                    <div class="news_categories">
                        <div class="title_container">
                            <h4>Categories</h4>
                            <span class="decor_default"></span>
                        </div>
                        <ul>
                            @foreach($category as $cat)
                            <li><a href="{{ route('category-news',['id'=>$cat->id,'slug'=>str_slug($cat->name)]) }}"><i class="fa fa-angle-right"></i>{{ $cat->name }}</a></li>
                            @endforeach
                        </ul>
                    </div> <!-- /news_categories -->
                    <div class="instagram_photos">
                        <div class="title_container">
                            <h4>News Photos</h4>
                            <span class="decor_default"></span>
                        </div>
                        <div class="more_project_gallery">
                            <div>
                                @foreach($news_rand as $n)
                                <div class="img_holder"><img style="width: 84px" class="img-responsive" src="{{ asset('assets/images') }}/{{ $n->image }}" alt="images">
                                    <div class="hover_overlay hvr-shutter-out-vertical">
                                        <div class="content">
                                            <a class="fancybox" href="#"><i class="fa fa-link"></i></a>
                                        </div>
                                    </div>
                                </div> <!-- /img_holder -->
                                @endforeach
                            </div>
                        </div> <!-- /more_project_gallery -->
                    </div> <!-- /instragram_photos -->
                </div> <!-- /blog_aside -->
            </div> <!-- /row -->
        </div> <!-- /contianer -->
    </div>


    <!-- =========================== /News container =================== -->


@endsection

