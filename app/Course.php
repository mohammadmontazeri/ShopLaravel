<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable=[
        'title','detail','summery','image','cat_id','viewed','like','tag','price'
    ];
}