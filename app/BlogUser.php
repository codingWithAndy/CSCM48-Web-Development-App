<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogUser extends Model
{
    //
    public function blogPosts()
    {
        return $this->hasMany('App\BlogPost');
    }

    public function blogComments()
    {
        return $this->hasMany('App\BlogComment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
