<?php
namespace App\Http\Controllers\Frontend\Dashboard;

use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Frontend\SettingRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('frontend.dashboard.setting', compact('user'));
    }
    public function updateProfile(SettingRequest $request){
        $request->validated();
        $user = User::findOrFail(Auth::user()->id);
        $user->update($request->except(['_token', 'image']));
        ImageManager::uploadImage($request, $user);
        return redirect()->back()->with('success', 'Profile updated successfully');
    }
    public function changePassword(Request $request){
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = User::findOrFail(Auth::user()->id);

        if (!Hash::check($request->current_password, $user->password)) {
            Session::flash('error', 'Password not correct!');
            return redirect()->back();
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);
        return redirect()->back()->with('success', 'Password updated successfully!');
    }
}
