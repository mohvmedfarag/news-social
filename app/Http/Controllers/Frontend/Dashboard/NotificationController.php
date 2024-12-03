<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return view('frontend.dashboard.notifications', compact('user'));
    }
    public function delete(Request $request)
    {
        $notify = auth()->user()->notifications()->where('id', $request->notify_id)->first();
        if (!$notify) {
            Session::flash('error', 'notify not found!'); 
            return redirect()->back();
        }
        $notify->delete();
        Session::flash('success', 'notify deleted successfully!');
        return redirect()->back();
    }
    public function deleteAll()
    {
        Auth::user()->notifications()->delete();
        Session::flash('success', 'notifications deleted successfully!');
        return redirect()->back();
    }

}
