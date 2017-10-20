<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //one category can have many posts
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
