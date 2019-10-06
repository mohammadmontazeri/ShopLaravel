<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;

class CourseController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::latest()->paginate(2);
        return view('admin.course.index',compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
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
            'title' => 'required|unique:courses',
            'cat_id' => 'required',
            'summery' => 'required',
            'detail' => 'required',
            'tag' => 'required',
            'image' => 'required',
        ]);
        //  return $request;die;
        if (!empty($request->price)){
            $price = $request->price;
        }
        $imgUrl = $this->imageuploader($request->image);
        Course::create([
            'title' => $request->title,
            'cat_id' => $request->cat_id,
            'summery' => $request->summery,
            'detail' => $request->detail,
            'tag' => implode($request->tag,','),
            'image'=> $imgUrl,
            'price'=>$price
        ]);

        return back()->with('msg','دوره مورد نظر با موفقیت افزوده شد ');
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
            if (file_exists("public$course->image")){
                unlink("public$course->image");
            }
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
    public function destroy(Course $course)
    {
        if (file_exists("public$course->image")) {
            unlink("public$course->image");
        }
        $course->delete();
        return back()->with('msg','دوره مورد نظرتان با موفقیت حذف شد');
    }
}
