<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\BlogComment;
use App\Tag;
use Image;

use Illuminate\Support\Facades\Auth;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blogPosts = BlogPost::paginate(10);

        return view('blogposts.index', ['blogposts' => $blogPosts]);
    }

    public function show($id)
    {
        $blogPost = BlogPost::findOrFail($id);

        return view('blogposts.posts', ['blogpost' => $blogPost]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $tags=Tag::all();
        return view('blogposts.create', ['tags'=>$tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'tag1' => 'nullable|integer',
            'tag2' => 'nullable|integer',
            'tag3' => 'nullable|integer',

        ]);

        $post = new BlogPost;

        $post->blog_title = $validatedData['title'];
        $post->blog_content = $validatedData['content'];
        $post->blog_user_id = auth()->user()->id; //Auth::id();

        //save image
        if ($request->hasFile('featured_image')){
            $image = $request->file('featured_image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->resize(800,400)->save($location);

            $post->image = $filename;
        }

        $post->save();

        $post->blogTags()->sync($request->tags, false);

        session()->flash('message', 'Blog post was created!');
        return redirect()->route('blog_post.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $blogPost = BlogPost::findOrFail($id);
        $tags = Tag::all();

        return view('blogposts.editblog', ['blogpost' => $blogPost, 'tags' => $tags]);
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
        $post = BlogPost::findOrFail($id);
        $blogPosts = BlogPost::paginate(10);

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            //'tag1' => 'nullable|integer',
            //'tag2' => 'nullable|integer',
            //'tag3' => 'nullable|integer',

        ]);

        $post->blog_title = $request->get('title');
        $post->blog_content = $request->get('content');

        $post->save();

        session()->flash('message', 'Blog post was editted!');
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
        $blogPost = BlogPost::findOrFail($id);
        $blogPost->delete();

        return redirect()->route('home')->with('message', 'Blog Was deleted.');

    }
}
