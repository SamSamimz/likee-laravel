<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class RegisterController extends Controller
{
  //__Index
  public function index():View 
  {
      return view('auth.register');
  }
  //__Register
  public function register(RegisterRequest $request) {
    $user = $request->validated();
    User::create($user);

    // Login the register user
    if(Auth::attempt($user)) {
      return Redirect::intended('/');
    } 

  }
}
