<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * **/

    public function index()
    {
    $articles = Article::latest()->paginate(3);
    return view('admin.article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required|unique:articles',
            'cat_id' => 'required',
            'summery' => 'required',
            'detail' => 'required',
            'tag' => 'required',
            'image' => 'required',
        ]);
        //  return $request;die;
        $imgUrl = $this->imageuploader($request->image);
        Article::create([
            'title' => $request->title,
            'cat_id' => $request->cat_id,
            'summery' => $request->summery,
            'detail' => $request->detail,
            'tag' => implode($request->tag,','),
            'image'=> $imgUrl
        ]);
        return back()->with('msg','مقاله مورد نظر با موفقیت افزوده شد ');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('admin.article.edit',compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        if ($request->title == $article->title){
            $request->validate([
                'title' => 'required',
                'summery' => 'required',
                'detail' => 'required',
            ]);
            $title = $article->title;
        }else{
            $request->validate([
                'title' => 'required|unique:articles',
                'summery' => 'required',
                'detail' => 'required',
            ]);
            $title = $request->title;
        }
        if ($request->image != ""){
            $imgUrl = $this->imageuploader($request->image);
        }else{
            $imgUrl = $article->image;
        }
        if ($request->tag){
            $tag = implode($request->tag,',');
        }else{
            $tag = $article->tag;
        }
        $article->update([
            'title' => $title,
            'cat_id' => $request->cat_id,
            'summery' => $request->summery,
            'detail' => $request->detail,
            'tag' => $tag,
            'image'=> $imgUrl
        ]);

        return redirect(route('article.index'))->with('msg','مقاله مورد نظرتان با موفقیت ویرایش شده است ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect(route('article.index'))->with('msg','مقاله مورد نظرتان با موفقیت حذف شده است ');
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $filenamewithextension = $request->file('upload')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();

            $filenametostore = $filename.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('/uploads/'),$filenametostore);
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset("public/uploads/".$filenametostore);
            $msg = 'تصویر مورد نظر شما با موفقیت آپلود شد';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

//            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
    }
}
