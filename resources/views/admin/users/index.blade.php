@extends('layouts.dashboard.app')
@section('title')
    Users
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users</h6>
            </div>

            @include('admin.users.filter.filter')

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Posts</th>
                                <th>Status</th>
                                <th>Country</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->posts_count}}</td>
                                <td>{{$user->block_status}}</td>
                                <td>{{$user->country}}</td>
                                <td>{{$user->created_at->format('Y-m-d')}}</td>
                                <td>
                                    <a href="javascript:void(0)"
                                    onclick="if(confirm('are you sure to delete the user')){
                                                document.getElementById('deleteUser{{ $user->id }}').submit()
                                            } return false"
                                    > <i class="fa fa-trash"></i> </a>
                                    <a href="javascript:void(0)"
                                    onclick="document.getElementById('blockUser{{ $user->id }}').submit()"
                                    ><i class="fa fa-ban"></i> </a>
                                    <a href="{{ route('admin.users.show', $user->id) }}"> <i class="fa fa-eye"></i> </a>
                                </td>

                                <form id="deleteUser{{ $user->id }}" method="POST"
                                action="{{ route('admin.users.destroy', $user->id) }}"
                                >@csrf @method('DELETE')</form>

                                <form id="blockUser{{ $user->id }}" method="POST"
                                action="{{ route('admin.users.changeStatus', $user->id) }}"
                                >@csrf</form>
                            </tr>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6"> No Users. </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{$users->appends(request()->input)->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
