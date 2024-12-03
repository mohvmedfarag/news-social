@extends('layouts.frontend.app')
@section('meta_desc')
    {{$getSetting->small_desc}}
@endsection
@push('canonical')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush
@section('title')
    Home
@endsection
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
@endsection

@section('content')
    <!-- Top News Start-->
    <div class="top-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6 tn-left">
                    <div class="row tn-slider">
                        @php
                        $latestThreePosts = $posts->take(3);
                    @endphp
                    @foreach ($latestThreePosts as $post)
                    <div class="col-md-6">
                        <div class="tn-img">
                            <img style="height: 315px" src="{{ $post->images->first()->path  ?? '' }}" />
                            <div class="tn-title">
                                <a href="{{route('frontend.post.show', $post->slug)}}">{{$post->title}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                        
                        

                    </div>
                </div>
                <div class="col-md-6 tn-right">
                    <div class="row">
                        @php
                        $latestFourPosts = $posts->take(4);
                    @endphp
                    @foreach ($latestFourPosts as $post)
                    <div class="col-md-6">
                        <div class="tn-img">
                            <img style="height: 169px" src="{{ $post->images->first()->path  ?? '' }}" />
                            <div class="tn-title">
                                <a href="{{route('frontend.post.show', $post->slug)}}">{{$post->title}}</a>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Top News End-->

    <!-- Category News Start-->
    <div class="cat-news">
        <div class="container">
            <div class="row">

                @foreach ($categories_with_posts as $category)
                    <div class="col-md-6">
                        <h2>{{ $category->name }}</h2>
                        <div class="row cn-slider">

                            @foreach ($category->posts as $post)
                                <div class="col-md-6">
                                    <div class="cn-img">
                                        <img
                                            src="{{ asset($post->images->first()->path) ?? '' }}" />
                            <div class="cn-title">
                                        <a href="{{route('frontend.post.show', $post->slug)}}">{{ $post->title }}</a>
                                    </div>
                                </div>
                        </div>
                @endforeach

            </div>
        </div>
        @endforeach

    </div>
    </div>
    </div>
    <!-- Category News End-->



    <!-- Tab News Start-->
    <div class="tab-news">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#featured">Oldest News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="featured" class="container tab-pane active">

                            @foreach ($oldest_news as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $post->images->first()->path  ?? '' }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{route('frontend.post.show', $post->slug)}}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        <div id="popular" class="container tab-pane fade">
                            @foreach ($greatest_posts_comments as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $post->images->first()->path  ?? '' }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{route('frontend.post.show', $post->slug)}}">{{ $post->title }} {{ $post->comments_count }} comment</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#m-viewed">Latest News</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#m-read">Most Read</a>
                        </li>

                    </ul>



                    @php
                        $latestThreePosts = $posts->take(3);
                    @endphp

                    <div class="tab-content">
                        {{-- content latest news --}}
                        <div id="m-viewed" class="container tab-pane active">

                            @foreach ($latestThreePosts as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img height="113px" src="{{ $post->images->first()->path  ?? '' }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{route('frontend.post.show', $post->slug)}}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                        {{-- most reading --}}
                        <div id="m-read" class="container tab-pane fade">


                            @foreach ($greatest as $post)
                                <div class="tn-news">
                                    <div class="tn-img">
                                        <img src="{{ $post->images->first()->path  ?? '' }}" />
                                    </div>
                                    <div class="tn-title">
                                        <a href="{{route('frontend.post.show', $post->slug)}}">{{ $post->title }} {{ $post->num_of_views }} views </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Tab News Start-->

    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">



                <div class="col-lg-9">
                    <div class="row">


                        @foreach ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img height="157px" src="{{ $post->images->first()->path  ?? '' }}" />
                                    <div class="mn-title">
                                        <a href="{{route('frontend.post.show', $post->slug)}}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{ $posts->links() }}

                    </div>
                </div>



                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Read More</h2>
                        <ul>
                            @foreach ($read_more_posts as $post)

                            <li><a href="{{route('frontend.post.show', $post->slug)}}">{{ $post->title }}</a></li>
                                
                            @endforeach
                            
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
