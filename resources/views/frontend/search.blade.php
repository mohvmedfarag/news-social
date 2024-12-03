@extends('layouts.frontend.app')
@section('title')
    Search
@endsection
@section('content')
    
<!-- Main News Start-->
<div class="main-news">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="row">

                    @foreach ($posts as $post)
                        <div class="col-md-4">
                            <div class="mn-img">
                                <img src="{{ $post->images->first()->path }}" />
                                <div class="mn-title">
                                    <a href="{{route('frontend.post.show', $post->slug)}}">{{ $post->title }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    
                </div>
                {{ $posts->links() }}
            </div>

        </div>
    </div>
</div>
<!-- Main News End-->

@endsection