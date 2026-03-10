@extends('layouts.dashboard.app')
@section('title')
    {{ $category->name }}
@endsection
@section('content')
    <center>
        <div class="card-body shadow col-10">
                <h2>Category {{$category->name}}</h2><br>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="name" value="Name: {{ $category->name }}" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="slug" value="slug: {{ $category->slug }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            @if ($category->status == true)
                            <input type="text" name="status" value="active" class="form-control">
                            @else
                            <input type="text" name="status" value="not-active" class="form-control">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                           <textarea name="small_desc" id="" cols="100" rows="5">{{$category->small_desc}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <a href="javascript:void(0)" class="btn btn-danger"
                            onclick="if(confirm('are you sure to delete {{ $category->name }}')){
                                        document.getElementById('deleteCategory{{ $category->id }}').submit()
                                    } return false">Delete</a>
                            {{-- <a href="" class="btn btn-primary">Edit</a> --}}
                            @if ($category->status == true)
                                <a href="javascript:void(0)" class="btn btn-danger"
                                onclick="document.getElementById('blockCategory{{ $category->id }}').submit()">Disable</a>
                            @else
                                <a href="javascript:void(0)" class="btn btn-success"
                                onclick="document.getElementById('blockCategory{{ $category->id }}').submit()">Activate</a>
                            @endif
                        </div>
                        <form id="deleteCategory{{ $category->id }}" method="POST"
                            action="{{ route('admin.categories.destroy', $category->id) }}">@csrf @method('DELETE')</form>

                        <form id="blockCategory{{ $category->id }}" method="POST"
                                action="{{ route('admin.categories.changeStatus', $category->id) }}"
                        >@csrf</form>
                    </div>
                </div>
            </div>
    </center>
@endsection
