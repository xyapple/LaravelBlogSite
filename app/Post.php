<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //handle the MassAssignmentException error
    protected $fillable = [
        'title', 'content', 'category_id','featured'
    ];
    //a post can only belong to one Category
    public function category()
    {
        return $this->belongsTo(App\Category);
    }

}
