@extends('layouts.font-end2')
@section('content')

    <section class="page page--text">

        <h1 class="page__title">News Details</h1>
        <ul class="breadcrumbs">
            <li class="breadcrumb">
                <a href="{{ route('home') }}" class="breadcrumb__link">Home</a>
            </li>
            <li class="breadcrumb">
                <a href="" class="breadcrumb__link">News Details</a>
            </li>
            <li class="breadcrumb">
                <a href="{{ route('category-news',['id'=>$news->category_id,'slug'=>str_slug($news->category->name)]) }}" class="breadcrumb__link">{{ $news->category->name }}</a>
            </li>

        </ul>

        <div class="container">

            <ul class="billing-news clearfix">
                @foreach($category as $cat)
                    <li class="news-category"><a class="news-category__link news-category__link--general-news" href="{{ route('category-news',['id'=>$cat->id,'slug'=>str_slug($cat->name)]) }}">{{ $cat->name }}</a></li>
                @endforeach
            </ul>
            <div class="text-page row">
                <div class="col-md-10 col-md-offset-1">
                    <h2 class="news-post__title news-post__title--page">{{ $news->title }}</h2>
                    <div class="text-center news-page__tags">
                        <span class="news-post__tag news-post__tag--time">{{ \Carbon\Carbon::parse($news->created_at)->format('d F Y h:i A') }}</span>
                    </div>


                    <div class="col-md-12 news-page__text">
                        {!! $news->description !!}
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

@endsection