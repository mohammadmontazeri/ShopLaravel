<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable=[
        'title','detail','summery','image','cat_id','viewed','like','tag','price'
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    public function videos()
    {
        return $this->hasMany('App\Video');
    }
}
