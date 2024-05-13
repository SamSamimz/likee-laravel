<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }


    public function index(){
        $user = Auth::user();
        $user = User::with(['posts.likes'])->find($user->id);
        $total = $user->posts->reduce(function($carry, $post) {
            return $carry +  $post->likes->count();
        },0);
        $posts = $user->posts;
        return view('profile',compact('user','posts','total'));
    } 

    //__Settings
    public function settings():View 
    {
        $profilePic = '/storage/profiles/DefaultProfile.png';
        if(auth()->user()->image) {
            $profilePic = '\storage/'.auth()->user()->image->path;
        }
        return view('settings',compact('profilePic'));
    }

    // __Update
    public function update(ProfileUpdateRequest $request) {
        if($request->hasFile('image')) {
            if($request->user()->image) {
                $request->user()->image->delete();
                unlink(public_path('\storage/'.$request->user()->image->path));
            }
            $image = $request->file('image');
            $imageName = $request->name."_".time().".".$image->getClientOriginalExtension();
            $path = $image->storeAs('profiles', $imageName ,'public');
            $request->user()->image()->create(['path' => $path]);
        }
        toastr()
            ->positionClass('toast-bottom-right')
            ->addSuccess('Profile updated!');
        return Redirect::back();
    }
}
