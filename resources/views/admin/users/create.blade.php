@extends('layouts.dashboard.app')
@section('title')
    Add User
@endsection
@section('content')
    <center>
        <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body shadow col-10">
                <h2>Create New User</h2><br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="enter name of user" value="{{ old('name') }}" class="form-control">
                            @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="username" value="{{ old('username') }}" placeholder="enter username of user" class="form-control">
                            @error('username')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="email" value="{{ old('email') }}" placeholder="enter user email" class="form-control">
                            @error('email')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="enter user phone number" class="form-control">
                            @error('phone')
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
                    <div class="col-6">
                        <div class="form-group">
                            <select name="email_verified_at" class="form-control">
                                <option selected disabled>select email status</option>
                                <option value="1">active</option>
                                <option value="0">not-active</option>
                            </select>
                            @error('email_verified_at')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="country" value="{{ old('country') }}" placeholder="enter country name" class="form-control">
                            @error('country')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="enter city name" class="form-control">
                            @error('city')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="street" value="{{ old('street') }}" placeholder="enter street name" class="form-control">
                            @error('street')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="password" name="password" placeholder="enter password" class="form-control">
                            @error('password')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="password" name="password_confirmation" placeholder="confirm password" class="form-control">
                            @error('password_confirmation')
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
