<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //

    public function blogPostTags()
    {
        return $this->belongsToMany('App\BlogPost');

    }    
    
    
}
