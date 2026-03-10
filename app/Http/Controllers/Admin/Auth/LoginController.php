<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest:admin'])->only(['showLoginForm', 'login']);
        $this->middleware(['auth:admin'])->only(['logout']);
    }
    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $request->validate( $this->filterData() );

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember_me)) {
            return redirect()->route('admin.home');
        }

        return redirect()->back()->withErrors('credentials not match');
    } 
    public function filterData(): array{
        return [
            'email' => 'required|email',
            'password' => 'required| min:8',
            'remember_me' => 'in:on,off',
        ];
    }

    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.showLoginForm');
    }
}
