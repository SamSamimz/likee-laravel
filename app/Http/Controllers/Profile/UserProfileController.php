<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user)
    {
        $user = User::with(['posts.likes'])->find($user->id);
        $total = $user->posts->reduce(function($carry, $post) {
            return $carry +  $post->likes->count();
        },0);
        $posts = $user->posts;
        return view('userProfile',compact('user','total','posts'));
    }
}
