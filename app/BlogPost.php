<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    //

    public function blogUser()
    {
        return $this->belongsTo('App\BlogUser');
    }

    public function blogComments()
    {
        return $this->hasMany('App\BlogComment');
    }
}
