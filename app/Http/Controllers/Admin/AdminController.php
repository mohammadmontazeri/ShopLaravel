<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Course;
use App\Like;
use App\Tag;
use App\User;
use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function imageuploader($file){
        $filename=time()."_".$file->getClientOriginalName();
        $path=public_path('/uploads/');
        $file->move($path,$filename);
        return "/uploads/".$filename;
    }

    public function ajax(Request $request)
    {
       /* */
        switch ($request->delete_type){

            case 'category':
                $cat = Category::where('id',$request->delete_id)->get()->first();
                $cat->delete();
                break;
            case 'user':
                $user = User::where('id',$request->delete_id)->get()->first();
                $user->delete();
                break;
            case 'tag':
                $tag = Tag::where('id',$request->delete_id)->get()->first();
                $tag->delete();
                break;
            case 'article':
                $article = Article::where('id',$request->delete_id)->get()->first();
                $article->delete();
                break;
            case 'course':
                $course = Course::where('id',$request->delete_id)->get()->first();
                $course->delete();
                break;
            case 'video':
                $video = Video::where('id',$request->delete_id)->get()->first();
                $video->delete();
                break;
        }
    }

}
