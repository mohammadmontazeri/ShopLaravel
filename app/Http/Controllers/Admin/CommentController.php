<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hekmatinasser\Verta\Verta;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::latest()->paginate(5);
        return view('admin.comment.index',compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comment.create');
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
            'text' => 'required'
        ]);
        if (isset($request->article_id)){
            Comment::create([
                'text'=> $request->text,
                'article_id' => $request->article_id,
                'user_id' => Auth()->user()->id,
                'related_to' => 'article'
            ]);
        }else{
            Comment::create([
                'text'=> $request->text,
                'course_id' => $request->course_id,
                'user_id' => Auth()->user()->id,
                'related_to' => 'course'
            ]);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        return view('admin.comment.edit',compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $comment->update([
            'text' => $request->text,
            'status' => $request->status
        ]);
        return redirect(route('comment.index'))->with('msg','کامنت با موفقیت ویرایش شد');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
    public function reply(Comment $comment, Request $request)
    {
        return view('admin.comment.reply',['comment'=>$comment,'related'=>$request->related]);
    }


    public function replyPost(Request $request , Comment $comment)
    {
        $request->validate([
            'text'=>'required'
        ]);
        if ($request->related=='article'){
            Comment::create([
                'text'=> $request->text,
                'article_id' => $comment->article_id,
                'user_id' => Auth()->user()->id,
                'related_to' => 'article',
                'parent' => $comment->id,
            ]);
        }else{
            Comment::create([
                'text'=> $request->text,
                'course_id' => $comment->course_id,
                'user_id' => Auth()->user()->id,
                'related_to' => 'course',
                'parent' => $comment->id,
            ]);
        }
        $comment->update([
            'is_parent' => '1'
        ]);
        return back()->with('msg','کامنت مورد نظر با موفقیت افزوده شد ');
    }
}
