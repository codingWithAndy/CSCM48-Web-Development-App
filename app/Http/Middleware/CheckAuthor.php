<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\BlogPost;

class CheckAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd($request->id);
        $blogpost = BlogPost::findOrFail($id);
        $blogAuthor = $request->blog_user_id;
        dd($$blogAuthor);


        if($blogAuthor == auth()->user()->id){
            return $next($request);

        } else {
            dd($blogAuthor, auth()->user()->id);
            return response("You did not create this blog!");
        }


        
    }
}
