<?php

namespace App\Http\Controllers;

use App\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BlogPost;

class BlogCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        //
        $post = BlogPost::findOrFail($post_id);
        $validatedData = $request->validate([
            'content' => 'required|max:255',

        ]);

        $comment = new BlogComment;

        $comment->comment_for_blog = $validatedData['content'];
        
        $comment->comment_user_id = Auth::id();

        $comment->blogPost()->associate($post); //need to figute out how to grab current blog post.
        $comment->save();

        session()->flash('message', 'Blog comment was created!');
        return redirect()-> route('blog_post.show', $post->id);
        //return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
