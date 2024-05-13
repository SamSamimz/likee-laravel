<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    //__like
    public function like(Post $post,Request $request) {
        if($post->likedBy($request->user())) {
            $request->user()->likes()->where('post_id',$post->id)->delete();
        }else {
            $post->likes()->create([
                'user_id' => $request->user()->id,
            ]);
        }
        return redirect()->back();
    }
}
