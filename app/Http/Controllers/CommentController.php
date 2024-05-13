<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //__comment
    public function comment(Post $post, Request $request)
    {
        $request->validate(['comment' => 'required']);
        
        $post->comments()->create([
            'user_id' => $request->user()->id,
            'comment' => $request->comment,
        ]);
        toastr()
            ->positionClass('toast-bottom-right')
            ->addSuccess('Comment submited successfully');
        return redirect()->back();

    }
}
