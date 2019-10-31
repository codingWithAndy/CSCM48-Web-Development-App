<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    //
    public function blogPost()
    {
        return $this->belongsTo('App\BlogPost');
    }

}
