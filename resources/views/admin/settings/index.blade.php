@extends('layouts.dashboard.app')
@section('title')
    Setting
@endsection
@section('content')
    <center>
        <form action="{{ route('admin.settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body shadow col-10">
                <h2>Update Setting</h2><br>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="site_name" value="{{ $setting->site_name }}" placeholder="enter site_name of user" class="form-control">
                            @error('site_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="facebook" value="{{ $setting->facebook }}" placeholder="enter facebook of user" class="form-control">
                            @error('facebook')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="instagram" value="{{ $setting->instagram }}" placeholder="enter user instagram" class="form-control">
                            @error('instagram')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="youtube" value="{{ $setting->youtube }}" placeholder="enter user youtube number" class="form-control">
                            @error('youtube')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="email" value="{{ $setting->email }}" placeholder="enter user email" class="form-control">
                            @error('email')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="phone" value="{{ $setting->phone }}" placeholder="enter user phone number" class="form-control">
                            @error('phone')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="country" value="{{ $setting->country }}" placeholder="enter country name" class="form-control">
                            @error('country')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="city" value="{{ $setting->city }}" placeholder="enter city name" class="form-control">
                            @error('city')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="text" name="street" value="{{ $setting->street }}" placeholder="enter street name" class="form-control">
                            @error('street')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <textarea name="small_desc" id="" cols="100" rows="3">{{$setting->small_desc}}</textarea>
                            @error('small_desc')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" class="dropify" name="logo" data-default-file="{{ asset($setting->logo) }}" />
                            @error('logo')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="file" class="dropify" name="favicon" data-default-file="{{ asset($setting->favicon) }}" />
                            @error('logo')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">update</button>
            </div>
        </form>
    </center>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
    integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $('.dropify').dropify();
    </script>
@endsection
