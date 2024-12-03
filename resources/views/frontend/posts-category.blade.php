@extends('layouts.frontend.app')
@section('meta_desc')
    {{ $category->small_desc }}
@endsection
@push('canonical')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush
@section('title')
    {{ $category->name }}
@endsection
@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')
    <br /><br />
    <!-- Main News Start-->
    <div class="main-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col-md-4">
                                <div class="mn-img">
                                    <img src="{{ asset($post->images->first()->path) }}" />
                                    <div class="mn-title">
                                        <a href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info"> Category is empty... </div>
                        @endforelse


                    </div>
                    {{ $posts->links() }}
                </div>

                <div class="col-lg-3">
                    <div class="mn-list">
                        <h2>Other Categories</h2>
                        <ul>
                            @foreach ($categories as $category)
                                <li><a
                                        href="{{ route('frontend.category.posts', $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main News End-->
@endsection
