<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogUser extends Model
{
    //
    public function blogPost()
    {
        return $this->hasMany('App\BlogPost');
    }

}
