<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //a post can only belong to one Category
    public function category()
    {
        return $this->belongsTo(App\Category);
    }
}
