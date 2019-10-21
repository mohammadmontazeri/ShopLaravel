<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
      'user_id','course_id','price','authority'
    ];

    public function courses()
    {
        return $this->hasOne(Course::class);
    }
}
