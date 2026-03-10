@extends('layouts.dashboard.app')
@section('title')
    Categories
@endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
            </div>

            {{-- @include('admin.users.filter.filter') --}}

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Posts</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $category)
                            <tr>
                                <td>#{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->posts_count}}</td>
                                <td>@if ($category->status == true)
                                    active
                                @else
                                    not-active
                                @endif</td>
                                <td>
                                    <a href="#"
                                        data-toggle="modal"
                                        data-target="#editCategoryModal"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-slug="{{ $category->slug }}"
                                        data-small_desc="{{ $category->small_desc }}"
                                        data-status="{{ $category->status }}"
                                        class="editCategoryBtn">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                    onclick="if(confirm('are you sure to delete this category')){
                                                document.getElementById('deleteCategory{{ $category->id }}').submit()
                                            } return false"
                                    > <i class="fa fa-trash"></i> </a>
                                    <a href="javascript:void(0)"
                                    onclick="document.getElementById('blockCategory{{ $category->id }}').submit()"
                                    ><i class="fa fa-ban"></i> </a>
                                    <a href="{{ route('admin.categories.show', $category->id) }}"> <i class="fa fa-eye"></i> </a>
                                </td>

                                <form id="deleteCategory{{ $category->id }}" method="POST"
                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                >@csrf @method('DELETE')</form>

                                <form id="blockCategory{{ $category->id }}" method="POST"
                                action="{{ route('admin.categories.changeStatus', $category->id) }}"
                                >@csrf</form>
                            </tr>
                            @empty
                                <tr>
                                    <td class="alert alert-info" colspan="6"> No Categories. </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    {{-- {{$users->appends(request()->input)->links()}} --}}
                </div>
            </div>
        </div>

        {{-- edit modal --}}
        <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="edit_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" id="edit_slug" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Small Description</label>
                                <textarea name="small_desc" id="edit_small_desc" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" id="edit_status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Not Active</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="editCategoryForm" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('.editCategoryBtn');

            buttons.forEach(button => {
                button.addEventListener('click', function () {

                    let id = this.getAttribute('data-id');
                    let name = this.getAttribute('data-name');
                    let slug = this.getAttribute('data-slug');
                    let small_desc = this.getAttribute('data-small_desc');
                    let status = this.getAttribute('data-status');

                    document.getElementById('edit_name').value = name;
                    document.getElementById('edit_slug').value = slug;
                    document.getElementById('edit_small_desc').value = small_desc;
                    document.getElementById('edit_status').value = status;

                    // set dynamic form action
                    let form = document.getElementById('editCategoryForm');
                    form.action = `/admin/categories/${id}`;
                });
            });
        });
</script>
@endsection
