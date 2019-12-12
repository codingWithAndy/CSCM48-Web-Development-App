<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\BlogComment;
use App\Tag;

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


    // Trying to add twitter API functionality
    /*public function tweet(Twitter $t) {
        $t = app()->make('twitter');

        require "Apptwitteroauth/autoload.php";

        // Connect to the API
        $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecre);
        $content = $connection->get("account/verify_credentials");

        // Create a tweet
        $newStatus = $connection->post("status/update", ["status" => 'This tweet was sent via bloggy blogs']);

        // Get tweets
        $statuses = $connection->get("status/home_timeline", ["count" => 25, "exclude_replies" => true]);
    }
*/
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
        //$post->blogTags()->attach([$post->id, $validatedData['tag1']]);
        //$post->blogTags()->attach([$post->id, $validatedData['tag2']]);
        //$post->blogTags()->attach([$post->id, $validatedData['tag3']]);
        
        //$post->blogtags->tag_id =  $validatedData['tag3'];

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



        $post->blog_title = $validatedData['title'];
        $post->blog_content = $validatedData['content'];

        $post->save();
 
        return view('blog_post.index', ['blogpost' => $blogPosts]);



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
