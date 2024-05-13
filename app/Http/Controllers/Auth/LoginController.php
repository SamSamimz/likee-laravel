<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    //__Index
    public function index():View 
    {
        return view('auth.login');
    }

    //__Login
    public function login(LoginRequest $request) {
        $user = $request->validated();
        if(Auth::attempt($user)) {
            return redirect()->intended('/');
        }else {
            return back()->with('error','Invalid Credentials!');
        }
    }
}
