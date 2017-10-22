<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    //handle the MassAssignmentException error
    protected $fillable = [
        'title', 'content', 'category_id','featured'
    ];

    protected $dates=['deleted_at'];
    
    //a post can only belong to one Category
    public function category()
    {
        return $this->belongsTo(App\Category);
    }

}
