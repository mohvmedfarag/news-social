@extends('layouts.dashboard.app')
@section('title')
    roles
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Role Management</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Role Management</h6>
            </div>

            @include('admin.roles.filter.filter')

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($roles as $role)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $role->role }}</td>
                                    <td>
                                        @foreach (json_decode($role->permissions, true) ?? [] as $perm)
                                            <span class="badge badge-info">{{ $perm }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="if(confirm('Do you want to delete the role')){document.getElementById('delete_role_{{ $role->id }}').submit()} return false"><i
                                                class="fa fa-trash"></i></a>

                                        <a href="{{ route('admin.roles.edit', $role->id) }}"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>

                                <form id="delete_role_{{ $role->id }}"
                                    action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>

                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="8"> No roles</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $roles->appends(request()->input())->links() }}
                </div>

            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
