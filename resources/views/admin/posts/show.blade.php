@extends('layouts.dashboard.app')
@section('title')
Show Post
@endsection
@section('content')
    <center>
        <div class="card-body shadow col-10">
                <h2>Post {{$post->title}}</h2><br>
                <div class="col-6">
                        <div class="form-group">
                            @foreach ($post->images as $image)
                                <img src="{{ asset($image->path) }}" class="img-thumbnail" width="150px" height="150px">
                            @endforeach
                        </div>
                    </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <textarea name="desc" id="" cols="100" rows="5">{{$post->desc}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <textarea name="small_desc" id="" cols="100" rows="5">{{$post->small_desc}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="status" value="Status: {{ $post->format_status }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="comment_able" value="Comment Able: {{ $post->ability }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="category_id" value="Category: {{ $post->category->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="user" value="User: {{$post->user->name ?? $post->admin->name}}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <ul class="list-group">
                            <li class="list-group-item active">Comments : {{$post->comments->count()}}</li>
                            @forelse ($post->comments as $comment)
                            <li class="list-group-item">{{$comment->user->name}} say: {{$comment->comment}}</li>
                            @empty
                                <li class="list-group-item">no comments.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
    </center>
@endsection
