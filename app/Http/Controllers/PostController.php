<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Redirect::route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = $request->validated();
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = "IMG_".time().".".$image->getClientOriginalExtension();
            $path = $image->storeAs('posts',$imageName,'public');
            $post['image'] = $path;
            $request->user()->posts()->create($post);
            toastr()
                ->positionClass('toast-bottom-right')
                ->addSuccess('Post Created Successfully!');
            return Redirect::route('home');
        }else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post):View
    {
        $likers = Like::where('post_id', $post->id)->get();
        $commenters = Comment::where('post_id', $post->id)->latest()->paginate(5);
        return view('posts.show',compact('post', 'likers','commenters'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post, Request $request)
    {
        if($post->user_id == $request->user()->id) {
            return view('posts.editPost', compact('post'));
        }else {
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post,Request $request)
    {
        if($post->user_id == $request->user()->id) {
            $post->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);
        }else {
            abort(404);
        }
        toastr()
                ->positionClass('toast-bottom-right')
                ->addSuccess('Post Edited Successfully!');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);        
        if(file_exists(public_path('storage/'.$post->image))) {
            unlink(public_path(('storage/'.$post->image)));
        }
        $post->delete();
        return redirect()->route('profile')->with('success', 'Delete Successfully');
    }
}
