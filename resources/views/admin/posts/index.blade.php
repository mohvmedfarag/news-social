@extends('layouts.dashboard.app')
@section('title')
    Posts
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Posts</h6>
            </div>

            @include('admin.posts.filter.filter')

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($posts as $post)
                            <tr>
                                <td>#{{$post->id}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->category->name}}</td>
                                <td>{{$post->user->name ?? $post->admin->name}}</td>
                                <td>{{$post->format_status}}</td>
                                <td>{{$post->num_of_views}}</td>
                                <td>
                                    <a href="javascript:void(0)"
                                    onclick="if(confirm('are you sure to delete the post')){
                                                document.getElementById('deletePost{{ $post->id }}').submit()
                                            } return false"
                                    > <i class="fa fa-trash"></i> </a>
                                    <a href="javascript:void(0)"
                                    onclick="document.getElementById('blockPost{{ $post->id }}').submit()"
                                    ><i class="fa fa-ban"></i> </a>
                                    <a href="{{ route('admin.posts.show', $post->id) }}"> <i class="fa fa-eye"></i> </a>
                                </td>

                                <form id="deletePost{{ $post->id }}" method="POST"
                                action="{{ route('admin.posts.destroy', $post->id) }}"
                                >@csrf @method('DELETE')</form>

                                <form id="blockPost{{ $post->id }}" method="POST"
                                action="{{ route('admin.posts.changeStatus', $post->id) }}"
                                >@csrf</form>
                            </tr>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6"> No posts. </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{$posts->appends(request()->input)->links()}}
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
