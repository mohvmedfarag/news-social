@extends('layouts.dashboard.app')
@section('title')
Show User
@endsection
@section('content')
    <center>
        <div class="card-body shadow col-10">
                <h2>User {{$user->name}}</h2><br>
                <div class="col-6">
                        <div class="form-group">
                            <img src="{{ asset($user->image) }}" class="img-thumbnail" width="250px" height="250px">
                        </div>
                    </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name" value="Name: {{ $user->name }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="username" value="Username: {{ $user->username }}" class="form-control">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="email" value="Email: {{ $user->email}}" class="form-control">

                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="phone" value="Phone: {{ $user->phone }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="status" value="Status: {{ $user->block_status }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="created_at" value="Registration: {{ $user->created_at }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="country" value="Country: {{ $user->country }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="city" value="City: {{ $user->city }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="street" value="Street: {{ $user->street }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <a href="javascript:void(0)" class="btn btn-danger"
                            onclick="if(confirm('are you sure to delete {{ $user->name }}')){
                                        document.getElementById('deleteUser{{ $user->id }}').submit()
                                    } return false">Delete</a>
                            {{-- <a href="" class="btn btn-primary">Edit</a> --}}
                            @if ($user->status == true)
                                <a href="javascript:void(0)" class="btn btn-danger"
                                onclick="document.getElementById('blockUser{{ $user->id }}').submit()">Block</a>
                            @else
                                <a href="javascript:void(0)" class="btn btn-success"
                                onclick="document.getElementById('blockUser{{ $user->id }}').submit()">Unblock</a>
                            @endif
                        </div>
                        <form id="deleteUser{{ $user->id }}" method="POST"
                            action="{{ route('admin.users.destroy', $user->id) }}">@csrf @method('DELETE')</form>

                        <form id="blockUser{{ $user->id }}" method="POST"
                                action="{{ route('admin.users.changeStatus', $user->id) }}"
                        >@csrf</form>
                    </div>
                </div>
            </div>
    </center>
@endsection
