<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\Comment;
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
use Illuminate\Support\Facades\DB;

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
            case 'comment':
                $comment = Comment::where('id',$request->delete_id)->get()->first();
                if ($comment->is_parent == '1'){
                        return response()->json('کامنت مورد نظر دارای زیر پاسخ می باشد');
                }else{
                    $parent = $comment->parent;
                    $comment->delete();
                    if ($parent != ""){
                        $com = Comment::where('parent','=',$parent)->get();
                        if (empty($com[0])) {
                            $par = Comment::where('id', '=', $parent)->get()->first();
                            $par->update([
                                'is_parent' => '0'
                            ]);
                        }
                    }
                }
                break;
        }
    }

    public function courseEpisode(Request $request,$id)
    {
        $course = DB::table('courses')->where('id','=',$id)->get();
        $videos = DB::table('videos')->where('course_id','=',$course[0]->id)->get();
        //return $videos;
       return response()->json(['data'=>$videos]);
    }
    public function search(Request $request)
    {
        //return $request->value;
        $data = $request->value;
         $array[0]=DB::table("courses")
            ->join("categories",'categories.id','=','courses.cat_id')
            ->select('courses.*')
            ->orWhere("courses.title","like","%$data%")
//            ->orWhere("courses.tag","like","%$data%")
            ->get();
        if (count($array[0]) != 0 ){
            foreach ($array[0] as $key=>$item){
                $course[$key] = $item ;
            }
        }else{
            $course = [];
        }
        $array[1]=DB::table("articles")
            ->join("categories",'categories.id','=','articles.cat_id')
            ->select('articles.*')
            ->orWhere("articles.title","like","%$data%")
            ->get();
        if (count($array[1]) != 0 ){
            foreach ($array[1] as $key=>$item){
                $article[$key] = $item ;
            }
        }else{
            $article = [];
        }
        $array[2]=DB::table("videos")
            ->join("courses",'courses.id','=','videos.course_id')
            ->select('videos.*','courses.price as curl')
            ->orWhere("videos.title","like","%$data%")
            ->get();
        if (count($array[2]) != 0 ){
            foreach ($array[2] as $key=>$item){
                $video[$key] = $item ;
            }
        }else{
           $video = [];
        }
        $res = array_merge($course,$article,$video);
        if (count($res) == 0){
            return response()->json(['data'=>"empty"]);
        }else {
            return response()->json(['data' => $res]);
        }
    }

}
