@extends('layouts.frontend.app')
@section('title')
    Profile
@endsection
@push('canonical')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li class="breadcrumb-item active">dashboard</li>
@endsection
@section('content')
    <!-- Profile Start -->
    <div class="dashboard container">
        @include('frontend.dashboard._sidebar', ['profile_active' => 'active'])

        <!-- Main Content -->
        <div class="main-content">
            <!-- Profile Section -->
            <section id="profile" class="content-section active">
                <h2>User Profile</h2>
                <div class="user-profile mb-3">
                    <img src="{{ asset( Auth::user()->image ) }}" alt="User Image" class="profile-img rounded-circle"
                        style="width: 100px; height: 100px;" />
                    <span class="username">{{ Auth::user()->name }}</span>
                </div>
                <br>

                @if (session()->has('errors'))
                <div class="alert alert-danger">
                @foreach (session('errors')->all() as $error)
                <li> {{$error}}</li> <br>
                @endforeach
            </div>
                @endif

                <form action="{{route('frontend.dashboard.post.share')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Add Post Section -->
                <section id="add-post" class="add-post-section mb-5">
                    <h2>Add Post</h2>
                    <div class="post-form p-3 border rounded">
                        <!-- Post Title -->
                        <input type="text" name="title" id="postTitle" class="form-control mb-2" placeholder="Post Title" />
                        <!-- small desc -->
                        <textarea name="small_desc" class="form-control mb-2" rows="3" placeholder="Enter small description"></textarea>
                        <!-- Post Content -->
                        <textarea id="postContent" name="desc" class="form-control mb-2" rows="3" placeholder="What's on your mind?"></textarea>

                        <!-- Image Upload -->
                        <input type="file" id="postImage" name="images[]" class="form-control mb-2" accept="image/*" multiple />
                        <div class="tn-slider mb-2">
                            <div id="imagePreview" class="slick-slider"></div>
                        </div>

                        <!-- Category Dropdown -->
                        <select id="postCategory" name="category_id" class="form-control" style="padding: 0px">
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                            
                        </select><br>

                        <!-- Enable Comments Checkbox -->
                        <label class="form-check-label mb-2">
                            Enable Comments: <input name="comment_able" type="checkbox" class="" /> 
                        </label><br>

                        <!-- Post Button -->
                        <button type="submit" class="btn btn-primary post-btn">Share</button>
                    </div>
                </section>
                </form>

                <!-- Posts Section -->
                <section id="posts" class="posts-section">
                    <h2>Recent Posts</h2>
                    <div class="post-list">
                        <!-- Post Item -->
                    
                            
                        
                            
                        @forelse ($posts as $post)

                        <div class="post-item mb-4 p-3 border rounded">
                            <div class="post-header d-flex align-items-center mb-2">
                                <img src="{{ asset( Auth::user()->image ) }}" alt="User Image" class="rounded-circle"
                                    style="width: 50px; height: 50px;" />
                                <div class="ms-3">
                                    <h5 class="mb-0">{{ Auth::user()->name }}</h5>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>

                            <h4 class="post-title">{{$post->title}}</h4>
                            <p class="post-content">{!! chunk_split($post->desc,50) !!}</p>

                            <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#newsCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#newsCarousel" data-slide-to="1"></li>
                                    <li data-target="#newsCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    @foreach ($post->images as $image)
                                        
                                    <div class="carousel-item  @if($loop->index == 0) active @endif">
                                        <img src="{{ asset($image->path) }}" class="d-block w-100" alt="First Slide">
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

                            <div class="post-actions d-flex justify-content-between">
                                <div class="post-stats">
                                    <!-- View Count -->
                                    <span class="me-3">
                                        <i class="fas fa-eye"></i> {{$post->num_of_views}} views
                                    </span>
                                </div>

                                <div>
                                    <a href="{{route('frontend.dashboard.post.edit', $post->slug)}}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="javascript:void(0)" onclick="if(confirm('Are You Sure To Delete This Post?')){document.getElementById('deletePost_{{$post->id}}').submit()} return false" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-thumbs-up"></i> Delete
                                    </a>
                                    
                                    <button id="commentbtn_{{$post->id}}" class="getComments" post-id = "{{$post->id}}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-comment"></i>Show Comments
                                    </button>
                                    <button id="hideComments_{{$post->id}}" style="display: none" class="hideComments" post-id = "{{$post->id}}" class="btn btn-sm btn-outline-secondary">
                                        <i class="fas fa-comment"></i>Hide Comments
                                    </button>
                                    <form id="deletePost_{{$post->id}}" action="{{route('frontend.dashboard.post.delete')}}" method="post">

                                        @csrf
                                        <input type="hidden"  name="slug" value="{{$post->slug}}"></input> 
                                    </form>
                                </div>
                                
                            </div>

                            <!-- Display Comments -->
                            <div id="displayComments_{{$post->id}}" class="comments" style="display: none">
                               
                                <!-- Add more comments here for demonstration -->
                            </div>
                        </div>
                        @empty
                        <div class="alert alert-info"> No Posts Founded </div>
                        @endforelse
                        <!-- Add more posts here dynamically -->
                    </div>
                </section>
            </section>
        </div>
    </div>
    <!-- Profile End -->
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            // initialize with defaults
            $("#postImage").fileinput({
                theme: 'fa5',
                allowedFileTypes: ['image'],
                showCancel: true,
                maxFileCount: 5,
                showUpload: false // Hides the upload button
            });
            $('#postContent').summernote({
                height: 150,
            });

            // get post comments
            $(document).on('click', '.getComments', function(e){
                e.preventDefault();
                var post_id = $(this).attr('post-id');

                $.ajax({
                    type: 'GET',
                    url: '{{route("frontend.dashboard.post.getComments", ":post_id")}}'.replace(':post_id', post_id),
                    success: function(response){
                        $('#displayComments_'+post_id).empty();
                        $.each(response.data, function(indexInArray, comment){
                            $('#displayComments_'+post_id).append(`

                                 <div class="comment">
                                    <img src="${comment.user.image}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">${comment.user.name}</span>
                                        <p class="comment-text">${comment.comment}</p>
                                    </div>
                                </div>

                            `).show();
                        })
                        $('#commentbtn_'+post_id).hide();
                        $('#hideComments_'+post_id).show();


                    }
                })
            });
            // hide post comments
            $(document).on('click', '.hideComments', function(e){
                e.preventDefault();
                var post_id = $(this).attr('post-id');
                // hide comments
                $('#displayComments_'+post_id).hide();
                // hide button (hide comments)
                $('#hideComments_'+post_id).hide();
                // show btn (show comments)
                $('#commentbtn_'+post_id).show();
            })
        });
    </script>
@endpush
