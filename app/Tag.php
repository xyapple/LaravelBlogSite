<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //handle the MassAssignmentException error
    protected $fillable = [
        'tag',
    ];
    //Many to Many relationship
    public function posts()
    {
        return $this -> belongsToMany('App\Post');
    }

}
