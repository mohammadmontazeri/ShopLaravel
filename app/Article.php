<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable=[
        'title','detail','summery','image','cat_id','viewed','like','tag'
    ];
}
