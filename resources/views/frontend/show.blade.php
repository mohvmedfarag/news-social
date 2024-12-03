@extends('layouts.frontend.app')
@section('meta_desc')
    {{$mainPost->small_desc}}
@endsection
@push('canonical')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush
@section('title')
    Show | {{$mainPost->title}}
@endsection

@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
  <li class="breadcrumb-item active"><a href="{{route('frontend.category.posts', $category->slug)}}">{{$category->name}}</a></li>
  <li class="breadcrumb-item active">{{$mainPost->title}}</li>
@endsection

@section('content')
    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#newsCarousel" data-slide-to="1"></li>
                            <li data-target="#newsCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($mainPost->images as $image)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <img src="{{ asset($image->path) }}" class="d-block w-100" alt="First Slide">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $mainPost->title }}</h5>
                                    </div>
                                </div>
                            @endforeach



                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="alert alert-info">Author : {{$mainPost->user->name}}</div>
                    <div class="sn-content">
                        {!! $mainPost->desc !!}
                    </div>

                    @auth
                        <!-- Comment Section -->
                    <div class="comment-section">
                        @if ($mainPost->comment_able == 1)

                        <!-- Comment Input -->
                        <form id="formComment" action="{{route('frontend.post.comments.store')}}" method="post">
                            <div class="comment-input">
                                @csrf
                                <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                                <input type="hidden" name="post_id" value="{{$mainPost->id}}" />
                                <input id="commentInput" name="comment" type="text" placeholder="Add a comment..." id="commentBox" />
                                <button type="submit">Post</button>
                            </div>
                        </form>

                        <div style="display: none" class="alert alert-danger" id="errorMsg">
                            <!-- display error -->
                        </div>
                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach ($mainPost->comments as $comment)
                            <div class="comment">
                                <img src="{{ asset($comment->user->image) }}" alt="User Image" class="comment-img" />
                                <div class="comment-content">
                                    <span class="username">{{ $comment->user->name }}</span>
                                    <p class="comment-text">{{ $comment->comment }}</p>
                                </div>
                            </div>
                            @endforeach
                            <!-- Add more comments here for demonstration -->
                        </div>
                        
                        <!-- Show More Button -->
                        @if ($mainPost->comments->count() > 2)
                        <button id="showMoreBtn" class="show-more-btn">Show more</button>
                        @endif
                        @else
                        <div class="alert alert-info">
                            unable to comment
                        </div>
                        @endif
                    </div>
                    @endauth

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach ($postsOfCategory as $post)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src="{{ asset($post->images->first()->path) }}" class="img-fluid"
                                            alt="{{ $post->title }}" />
                                        <div class="sn-title">
                                            <a
                                                href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach ($postsOfCategory as $post)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src="{{ asset($post->images->first()->path) }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a
                                                href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                        </div>
                                    </div>
                                @endforeach


                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">

                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#popular">Popular</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#latest">Latest</a>
                                    </li>
                                </ul>

                                <div class="tab-content">



                                    <div id="popular" class="container tab-pane active">
                                        @foreach ($popularPosts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ asset($post->images->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div id="latest" class="container tab-pane fade">
                                        @foreach ($latestPosts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ asset($post->images->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a
                                                        href="{{ route('frontend.post.show', $post->slug) }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>
                        </div>



                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a
                                                href="{{ route('frontend.category.posts', $category->slug) }}">{{ $category->name }}</a><span>({{ $category->posts->count() }})</span>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection

@push('js')
    <script>
        // show more comments
        $(document).on('click', "#showMoreBtn", function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('frontend.post.getAllComments', $mainPost->slug) }}",
                type: "GET",

                success: function(data) {
                    $('.comments').empty();
                    $.each(data, function(key, comment) {
                        $('.comments').append(`
                        <div class="comment">
                                <img src="${comment.user.image}" alt="User Image" class="comment-img" />
                                <div class="comment-content">
                                    <span class="username">${comment.user.name}</span>
                                    <p class="comment-text">${comment.comment}</p>
                                </div>
                            </div>
                        `);
                    });
                    $('#showMoreBtn').hide();
                },
                error: function(data) {

                }
            });
        })

        // add comment
        $(document).on('submit', '#formComment', function(e) {
            e.preventDefault();
            var formData = new FormData($(this)[0]);
            $('#commentInput').val('');
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "{{ route('frontend.post.comments.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (data) {
                    
                    $('#errorMsg').hide();
                    $('.comments').prepend(`
                         <div class="comment">
                                    <img src="${data.comment.user.image}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">${data.comment.user.name}</span>
                                        <p class="comment-text">${data.comment.comment}</p>
                                    </div>
                                </div>
                    `);
                },
                error: function (data){
                    var response = $.parseJSON(data.responseText);
                    $('#errorMsg').text(response.errors.comment).show();
                }
            });
        });
    </script>
@endpush
