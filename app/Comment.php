<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'text','article_id','course_id','is_parent','parent','user_id','related_to','status','episode_id'
    ];
}
