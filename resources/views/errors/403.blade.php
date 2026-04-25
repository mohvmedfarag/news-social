@extends('layouts.dashboard.app')
@section('title')
    403
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-center" style="min-height: 70vh;">
        <div class="text-center">

            <h1 class="display-1 text-danger font-weight-bold">403</h1>

            <h3 class="mb-3">Access Denied</h3>

            <p class="text-muted mb-4">
                You don’t have permission to access this page.
            </p>

            <div class="mb-4">
                <i class="fa fa-lock fa-3x text-danger"></i>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-outline-primary mr-2">
                <i class="fa fa-arrow-left"></i> Go Back
            </a>

            <a href="{{ route('admin.home') }}" class="btn btn-primary">
                <i class="fa fa-home"></i> Dashboard
            </a>

        </div>
    </div>
@endsection
