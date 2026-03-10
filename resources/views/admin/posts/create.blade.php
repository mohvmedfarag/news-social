@extends('layouts.dashboard.app')
@section('title')
    Add Post
@endsection
@section('content')
    <center>
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body shadow col-10">
                <h2>Create New Post</h2><br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="title" placeholder="enter title of post" value="{{ old('title') }}" class="form-control">
                            @error('title')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <!-- Image Upload -->
                            <input type="file" id="postImage" name="images[]" class="form-control mb-2" accept="image/*" multiple />
                            <div class="tn-slider mb-2">
                                <div id="imagePreview" class="slick-slider"></div>
                            </div>
                            @error('images')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="small_desc" placeholder="enter meta_desc of post" value="{{ old('small_desc') }}" class="form-control">
                            @error('small_desc')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <textarea name="desc" id="" cols="115" rows="5"></textarea>
                            @error('desc')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="comment_able" class="form-control">
                                <option selected>select comment_able</option>
                                <option value="1">active</option>
                                <option value="0">not-active</option>
                            </select>
                            @error('comment_able')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option selected>select post status</option>
                                <option value="1">active</option>
                                <option value="0">not-active</option>
                            </select>
                            @error('status')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="category_id" class="form-control">
                                <option selected disabled>categories</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </div>
        </form>
    </center>
@endsection
@section('script')
<script>
    $(function () {
        $("#postImage").fileinput({
            theme: "fa5",
            allowedFileTypes: ["image"],
            showCancel: true,
            maxFileCount: 5,
            showUpload: false
        });
    });
</script>
@endsection
