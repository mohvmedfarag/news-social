@extends('layouts.dashboard.app')
@section('title')
    Update Role
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
            @csrf
            @method('PUT')

            <div class="card-body shadow mb-4" style="min-width: 75ch">

                <!-- Header -->
                <div class="row">
                    <div class="col-9">
                        <h2>Update Role</h2>
                    </div>
                    <div class="col-3">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-primary">
                            Back To Roles
                        </a>
                    </div>
                </div>

                <br>

                <!-- Role Input -->
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            Enter Role:
                            <input type="text" name="role" value="{{ $role->role }}" class="form-control"
                                placeholder="Enter Role name">

                            @error('role')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Permissions -->
                <div class="row">
                    <div class="col-12">
                        <p><strong>Permissions</strong></p>
                    </div>

                    <!-- Select All -->
                    <div class="col-12 mb-3">
                        <div class="form-check">
                            <input type="checkbox" id="check_all" class="form-check-input">
                            <label for="check_all" class="form-check-label">
                                <strong>Select All</strong>
                            </label>
                        </div>
                    </div>

                    @php
                        $rolePermissions = json_decode($role->permissions, true) ?? [];
                    @endphp

                    @foreach (config('permissions') as $key => $value)
                        <div class="col-md-3 col-sm-6">
                            <div class="border p-3 rounded">
                                <div class="form-check mb-2">
                                    <input class="form-check-input perm-checkbox" type="checkbox" name="permissions[]"
                                        value="{{ $key }}" id="perm_{{ $key }}"
                                        @checked(in_array($key, $rolePermissions))>

                                    <label class="form-check-label" for="perm_{{ $key }}">
                                        {{ $value }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="col-12">
                        @error('permissions')
                            <strong class="text-danger">{{ $message }}</strong>
                        @enderror
                    </div>
                </div>

                <br>

                <button type="submit" class="btn btn-primary">
                    Update Role
                </button>

            </div>
        </form>
    </div>
@endsection
@section('script')
    <script>
        let selectAll = document.getElementById('check_all');

        selectAll.onclick = function() {
            let checkboxes = document.querySelectorAll('input[name="permissions[]"]');

            checkboxes.forEach(cb => cb.checked = selectAll.checked);
        }
    </script>
@endsection
