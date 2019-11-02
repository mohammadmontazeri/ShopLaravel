<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable=[
        'title','detail','summery','image','cat_id','viewed','like','tag','price','url','course_id','time'
    ];
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
    public function download_link()
    {
        $ci = $this->course->id ;
        $vi = $this->id;
        $ci_ = $ci*21 -2 ;
        $q = $vi*228 -5;
        return url("download-course?q=$q"."_"."$ci_");
    }


}
