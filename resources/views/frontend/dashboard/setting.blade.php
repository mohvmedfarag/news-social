@extends('layouts.frontend.app')
@section('title')
    Profile
@endsection
@push('canonical')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li class="breadcrumb-item active">setting</li>
@endsection
@section('content')
    <div class="dashboard container">
        @include('frontend.dashboard._sidebar', ['setting_active' => 'active'])

        <!-- Main Content -->

        <!-- Settings Section -->
        <div class='main-content'>
            <div>
                <h2>Settings</h2>
                <form class="settings-form" method="post" action="{{route('frontend.dashboard.setting.update')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="username">Name:</label>
                        <input type="text" name="name" id="username" value="{{$user->name}}" />
                        @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" value="{{$user->username}}" />
                        @error('username')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" value="{{$user->email}}" />
                        @error('email')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <label for="username">Phone:</label>
                            <input type="text" name="phone" id="username" value="{{$user->phone}}" />
                            @error('phone')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        </div>
                        <label for="profile-image">Profile Image:</label>
                        <input type="file" name="image" id="profile-image" accept="image/*" />
                        @error('image')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input type="text" name="country" id="country" value="{{$user->country}}"/>
                        @error('country')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" id="city" name="city" value="{{$user->city}}" />
                        @error('city')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input type="text" id="street" name="street" value="{{$user->street}}" />
                        @error('street')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="save-settings-btn">
                        Save Changes
                    </button>
                </form>

                <!-- Form to change the password -->
                <form class="change-password-form" action="{{route('frontend.dashboard.setting.changePassword')}}" method="post">
                    @csrf
                    <h2>Change Password</h2>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>
                        <input type="password" name="current_password" id="current-password" placeholder="Enter Current Password" />
                        @error('current_password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input type="password" name="password" id="new-password" placeholder="Enter New Password" />
                        @error('password')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input type="password" name="password_confirmation" id="confirm-password" placeholder="Enter Confirm New " />
                        @error('password_confirmation')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                    </div>
                    <button type="submit" class="change-password-btn">
                        Change Password
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
