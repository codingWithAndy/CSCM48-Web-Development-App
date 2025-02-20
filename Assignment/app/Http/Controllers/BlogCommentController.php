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
    public function index(BlogPost $post)
    {
        dd($post->blogComments()->with('user')->latest()->get());
        return response()->json($post->blogComments()->with('user')->latest()->get());
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

    // Ajax Index Call
    public function apiIndex(BlogPost $post)
    {
        $comment = BlogComment::where('blog_post_id', $post->id);
        //dd($post->blogComments()->with('user')->latest()->get());
        return response()->json($comment);

    }

    // Ajax Save Call
    public function apiStore(Request $request, BlogPost $post)
    {
        dd($request);
        $validatedData = $request->validate([
            'content' => 'required|max:255',

        ]);

        $comment = new BlogComment;
        $comment->comment_for_blog = $validatedData['content'];
        $comment->comment_user_id = Auth::id();
        $comment->blogPost()->associate($post);
        $comment->save();

        $comment = BlogComment::where('id', $comment->id)->with('user')->first();
        return response()->json(['comment' => $comment]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //, $post_id
    {
        //
        $post_id = $request->route()->parameters();
        $post_id = $post_id['post_id'];

        $post = BlogPost::findOrFail($post_id);
        $validatedData = $request->validate([
            'content' => 'required|max:255',

        ]);

        $comment = new BlogComment;

        $comment->comment_for_blog = $validatedData['content'];
        $comment->comment_user_id = Auth::id();
        $comment->blogPost()->associate($post);
        $comment->save();

        session()->flash('message', 'Blog comment was created!');
        return back();
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
        $comment = BlogComment::findOrFail($id);

        return view('blogposts.editcomment', ['comment' => $comment]);
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
        $comment = BlogComment::findOrFail($id);

        $validatedData = $request->validate([
            'comment' => 'required',

        ]);


        $comment->comment_for_blog = $request->get('comment');

        $comment->save();

        session()->flash('message', 'Comment was editted!');
        return redirect()->route('home');
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
