<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\frontend\NewSubscriberMail;
use App\Models\NewSubscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class NewSubscriberController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'email' => 'required|email|unique:new_subscribers,email',
        ]);

        $new_subscriber = NewSubscriber::create([
            'email' => $request->email,
        ]);

        if ($new_subscriber) {
            Mail::to($request->email)->send(new NewSubscriberMail());
            Session::flash('success','thanks for subscribe');
            return redirect()->back();
        }else{
            Session::flash('error','sorry try again');
            return redirect()->back();
        }
    }
}
