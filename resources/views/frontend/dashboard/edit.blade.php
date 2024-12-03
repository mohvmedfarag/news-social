@extends('layouts.frontend.app')
@section('title')
    Edit: {{ $post->title }}
@endsection
@push('canonical')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li class="breadcrumb-item active">edit</li>
    <li class="breadcrumb-item active">{{ $post->title }}</li>
@endsection
@section('content')
    <div class="dashboard container">
        @include('frontend.dashboard._sidebar')

        <!-- Main Content -->
        <div class="main-content col-md-9">
          @if (session()->has('errors'))
          <div class="alert alert-danger">
            @foreach (session('errors')->all() as $error)
            {{$error}}</br>
            @endforeach
          </div>
          @endif
            <!-- Show/Edit Post Section -->
            <section id="posts-section" class="posts-section">
                <h2>Your Posts</h2>
                <form action="{{ route('frontend.dashboard.post.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="post_id" value="{{$post->id}}" />
                    <ul class="list-unstyled user-posts">
                        <!-- Example of a Post Item -->
                        <li class="post-item">
                            <!-- Editable Title -->
                            <input type="text" name="title" class="form-control mb-2 post-title"
                                value="{{ $post->title }}" />
                                <textarea name="small_desc" id="" class="form-control mb-2 post-content">{!! $post->small_desc ?? '' !!}</textarea>
                            <!-- Editable Content -->
                            <textarea name="desc" id="post-desc" class="form-control mb-2 post-content">{!! $post->desc !!}</textarea>

                            <!-- Image Upload Input for Editing -->
                            <input type="file" id="postImages" name="images[]" class="form-control mt-2 edit-post-image"
                                accept="image/*" multiple />

                            <!-- Editable Category Dropdown -->
                            <select name="category_id" class="form-control mb-2 post-category">

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($post->category_id == $category->id)>{{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            <!-- Editable Enable Comments Checkbox -->
                            <div class="form-check mb-2">
                                <input name="comment_able" @checked($post->comment_able == 1)
                                    class="form-check-input enable-comments" type="checkbox" />
                                <label class="form-check-label">
                                    Enable Comments
                                </label>
                            </div>

                            <!-- Post Meta: Views and Comments -->
                            <div class="post-meta d-flex justify-content-between">
                                <span class="views">
                                    <i class="fas fa-eye"></i> {{ $post->num_of_views }}
                                </span>
                                <span class="post-comments">
                                    <i class="fas fa-comment"></i> {{ $post->comments->count() }}
                                </span>
                            </div>

                            <!-- Post Actions -->
                            <div class="post-actions mt-2">
                                <button type="submit" class="btn btn-success save-post-btn">
                                    Save
                                </button>
                                <a href="{{ route('frontend.dashboard.profile') }}"
                                    class="btn btn-secondary cancel-edit-btn">
                                    Cancel
                                </a>
                            </div>

                        </li>
                        <!-- Additional posts will be added dynamically -->
                    </ul>
                </form>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#post-desc').summernote({
                height: 150,
            });
            $("#postImages").fileinput({
                theme: 'fa5',
                allowedFileTypes: ['image'],
                showCancel: true,
                maxFileCount: 5,
                enableResumableUpload: true,
                showUpload: false, // Hides the upload button
                initialPreviewAsData: true,
                initialPreview: [
                    @if ($post->images->count() > 0)
                        @foreach ($post->images as $image)
                            "{{ asset($image->path) }}",
                        @endforeach
                    @endif
                ],
                initialPreviewConfig: [
                    @if ($post->images->count() > 0)
                        @foreach ($post->images as $image)
                            {
                                caption: '',
                                width: '120px',
                                url: "{{ route('frontend.dashboard.post.image.delete', [$image->id, '_token' => csrf_token()]) }}", // server delete action 
                                key: "{{$image->id}}",
                            },
                        @endforeach
                    @endif
                ],
                initialPreviewAsData: true,
            });

        });
    </script>
@endpush
