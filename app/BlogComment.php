<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    //
    public function blogPosts()
    {
        return $this->belongsTo('App\BlogPost');
    }


}
