@extends('layouts.frontend.app')
@section('title')
    Notifications
@endsection
@push('canonical')
    <link rel="canonical" href="{{url()->full()}}" />
@endpush
@section('breadcrumbs')
<li class="breadcrumb-item"><a href="{{ route('frontend.index') }}">Home</a></li>
    <li class="breadcrumb-item active">notifications</li>
@endsection
@section('content')
           <!-- Dashboard Start-->
           <div class="dashboard container">
            @include('frontend.dashboard._sidebar', ['notify_active' => 'active'])
    
            <!-- Main Content -->
            <div class="main-content">
                <div class="container">
                  <div class="row">
                    <div class="col-6">
                      <h2>Notifications</h2>
                    </div>
                    <div class="col-6">
                      <a href="{{route('frontend.dashboard.notifications.deleteAll')}}" class="btn btn-danger btn-sm" style="float: right;margin-right: 11px;margin-top:10px">Delete All</a>
                  </div>
                  </div>
                    
                   @forelse (auth()->user()->notifications as $notify)
                   <a href="{{ $notify->data['post_link'] }}">
                    <div class="notification alert alert-info">
                        <strong>You have a comment from: {{$notify->data['user_name']}}</strong> 
                        on your post {{$notify->data['post_title']}}<br>
                        before: {{ $notify->created_at->diffForHumans() }}
                        <div class="float-right">
                            <button onclick="if(confirm('Are u sure to delete this notify?')){document.getElementById('deleteNotify').submit()} return false" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                   </a>
                   <form id="deleteNotify" method="post" action="{{route('frontend.dashboard.notifications.delete')}}">
                    @csrf
                    <input type="hidden" name="notify_id" value="{{$notify->id}}" />
                   </form>
                   @empty
                   <div class="notification alert alert-info">There are no notifications available</div>
                   @endforelse
                   

                </div>
            </div>
          </div>
          <!-- Dashboard End-->
    
@endsection