@extends('layouts.dashboard.app')
@section('title')
    Show Admin
@endsection

@section('body')
    <center>
        <div class="card-body shadow mb-4 col-10">
            <h2>Admin : {{ $admin->name }}</h2><br>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Name : {{ $admin->name }}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value=" username : {{ $admin->username }}" class="form-control">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Email : {{ $admin->email }}" class="form-control">

                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Phone : {{ $admin->phone }}" class="form-control">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Status : {{ $admin->status == 1 ? 'Active' : 'Not Active' }}" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <input disabled value="Email Status : {{ $admin->email_verified_at == null ? 'Not Active' : 'Active' }}"
                            class="form-control">
                    </div>
                </div>
            </div>
        

            <br>
            <a href="{{ route('admin.admins.changeStatus', $admin->id) }}"
                class="btn btn-primary">{{ $admin->status == 1 ? 'Block' : 'Active' }}</a>
            <a href="javascript:void(0)"
                onclick="if(confirm('Do you want to delete the admin')){document.getElementById('delete_admin').submit()} return false"
                class="btn btn-info">Delete</a>
        </div>

        <form id="delete_admin" action="{{ route('admin.admins.destroy', $admin->id) }}" method="post">
            @csrf
            @method('DELETE')
        </form>
    </center>
@endsection
