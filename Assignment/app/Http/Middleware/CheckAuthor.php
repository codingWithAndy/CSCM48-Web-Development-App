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

        $idCheck = $request->route()->parameters();
        $idCheck = $idCheck['blog_post'];
        $blogpost = BlogPost::findOrFail($idCheck);
        $blogAuthor = $blogpost->blog_user_id;

        if($blogAuthor == auth()->user()->id){
            return $next($request);

        } else {

            return response("You did not create this blog!");
        }
    }
}
