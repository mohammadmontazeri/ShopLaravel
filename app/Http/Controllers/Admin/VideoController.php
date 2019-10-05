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
            'time'=> 'required'
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
            'course_id'=>$request->course,
            'time' => $request->time
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
    public function edit(Video $video)
    {
        return view('admin.video.edit',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        if ($request->title == $video->title){
            $request->validate([
                'title' => 'required',
                'summery' => 'required',
                'detail' => 'required',
                'price' => 'required',
                'time' => 'required',
            ]);
            $title = $video->title;
        }else{
            $request->validate([
                'title' => 'required|unique:articles',
                'summery' => 'required',
                'detail' => 'required',
                'price' => 'required',
                'time' => 'required'

            ]);
            $title = $request->title;
        }
        if ($request->url != ""){
            $videoUrl = $this->imageuploader($request->url);
        }else{
            $videoUrl = $video->url;
        }
        if ($request->tag){
            $tag = implode($request->tag,',');
        }else{
            $tag = $video->tag;
        }
        $video->update([
            'title' => $title,
            'summery' => $request->summery,
            'detail' => $request->detail,
            'tag' => $tag,
            'url'=> $videoUrl,
            'price'=> $request->price,
            'time'=> $request->time
        ]);
        $courseTitle = Course::where('id',$video->course_id)->get()->first();
        return redirect(route('video.index',['courseTitle'=>$courseTitle->title]))->with('msg','ویدیو مورد نظرتان با موفقیت ویرایش شده است ');

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
