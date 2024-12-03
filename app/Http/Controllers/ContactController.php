<?php

namespace App\Http\Controllers;

use App\Http\Requests\Frontend\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Session;

// use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('frontend/contact');
    }
    public function store(ContactRequest $request){
        $request->validated();
        $request->merge([
            'ip_address' => $request->ip()
        ]);
        $contact = Contact::create( $request->except(['_token']) );
        if (!$contact) {
            Session::flash('error', 'Contact message is failed');
            return redirect()->back();
        }
        Session::flash('success', 'Contact message sent successfully!');
        return redirect()->back();
    }
}
