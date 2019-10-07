<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Contact;
use App\Course;
use App\Like;
use App\Newsletter;
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
                if (file_exists("public$cat->image")){
                    unlink("public$cat->image");
                }
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
                if (file_exists("public$article->image")){
                    unlink("public$article->image");
                }
                $article->delete();
                break;
            case 'course':
                $course = Course::where('id',$request->delete_id)->get()->first();
                if (file_exists("public$course->image")){
                    unlink("public$course->image");
                }
                $course->delete();
                break;
            case 'video':
                $video = Video::where('id',$request->delete_id)->get()->first();
                $video->delete();
                break;
            case 'newsletter':
                $news = Newsletter::where('id',$request->delete_id)->get()->first();
                $news->delete();
                break;
            case 'contact':
                $con = Contact::where('id',$request->delete_id)->get()->first();
                $con->delete();
                break;
        }
    }

}
