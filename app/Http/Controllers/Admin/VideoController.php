<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;

class VideoController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $course = Course::where('title',$request->courseTitle)->get()->first();
        $videos = Video::where('course_id',$course->id)->latest()->paginate(2);
        return view('admin.video.index',['videos'=>$videos,'course'=>$course]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $course = $request->course;
        return view('admin.video.create',compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'summery' => 'required',
            'detail' => 'required',
            'tag' => 'required',
            'url' => 'required',
        ]);
        //  return $request;die;
        if (!empty($request->price)){
            $price = $request->price;
        }
        $videoUrl = $this->imageuploader($request->url);
        Video::create([
            'title' => $request->title,
            'summery' => $request->summery,
            'detail' => $request->detail,
            'tag' => implode($request->tag,','),
            'url'=> $videoUrl,
            'price'=>$price,
            'course_id'=>$request->course
        ]);

        return back()->with('msg','ویدیو مورد نظر با موفقیت افزوده شد ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        return view('admin.course.edit',compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        if ($request->title == $course->title){
            $request->validate([
                'title' => 'required',
                'summery' => 'required',
                'detail' => 'required',
                'price' => 'required'
            ]);
            $title = $course->title;
        }else{
            $request->validate([
                'title' => 'required|unique:articles',
                'summery' => 'required',
                'detail' => 'required',
                'price' => 'required'
            ]);
            $title = $request->title;
        }
        if ($request->image != ""){
            $imgUrl = $this->imageuploader($request->image);
        }else{
            $imgUrl = $course->image;
        }
        if ($request->tag){
            $tag = implode($request->tag,',');
        }else{
            $tag = $course->tag;
        }
        $course->update([
            'title' => $title,
            'cat_id' => $request->cat_id,
            'summery' => $request->summery,
            'detail' => $request->detail,
            'tag' => $tag,
            'image'=> $imgUrl,
            'price'=> $request->price
        ]);

        return redirect(route('course.index'))->with('msg','دوره مورد نظرتان با موفقیت ویرایش شده است ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        $video->delete();
        return back()->with('msg','ویدیو مورد نظرتان با موفقیت حذف شد');
    }
}
