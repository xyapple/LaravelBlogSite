<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    //handle the MassAssignmentException error
    protected $fillable = [
        'title', 'content', 'category_id','featured','slug',
    ];

    public function getFeaturedAttribute($featured)
    {
        return asset($featured);
    }

    protected $dates=['deleted_at'];

    //a post can only belong to one Category
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    //many to many relationship so we have to make a peakV table
    // tags, posts tables ==> post_tag(we have to create a database table name post_tag)
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

}
