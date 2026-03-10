@extends('layouts.dashboard.app')
@section('title')
    Add Category
@endsection
@section('content')
    <center>
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="card-body shadow col-10">
                <h2>Create New Category</h2><br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="enter name of category" value="{{ old('name') }}" class="form-control">
                            @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="slug" value="{{ old('slug') }}" placeholder="enter slug of category" class="form-control">
                            @error('slug')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <select name="status" class="form-control">
                                <option selected disabled>select status</option>
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
                            <textarea name="small_desc" cols="100" rows="5" aria-valuetext="{{ old('small_desc') }}"></textarea>
                            @error('small_desc')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">create</button>
            </div>
        </form>
    </center>
@endsection
