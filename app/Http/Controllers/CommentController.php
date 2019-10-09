<?php

namespace App\Http\Controllers;

use App\comment;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (isset($request->parent)){
            if ($request->c_type == 'article'){
                Comment::create([
                    'text'=> $request->message,
                    'article_id' => $request->c_id,
                    'user_id' =>$request->c_user,
                    'related_to' => 'article',
                    'parent'=>$request->parent
                ]);
            }else{
                Comment::create([
                    'text'=> $request->message,
                    'course_id' => $request->c_id,
                    'user_id' =>$request->c_user,
                    'related_to' => 'course',
                    'parent'=>$request->parent
                ]);
            }
            Comment::where('id',$request->parent)->update(['is_parent'=>'1']);
        }else{
            if ($request->c_type == 'article'){
                Comment::create([
                    'text'=> $request->message,
                    'article_id' => $request->c_id,
                    'user_id' =>$request->c_user,
                    'related_to' => 'article'
                ]);
            }else{
                Comment::create([
                    'text'=> $request->message,
                    'course_id' => $request->c_id,
                    'user_id' =>$request->c_user,
                    'related_to' => 'course'
                ]);
            }
        }
    }

    public function reply(Request $request)
    {
        $comment = Comment::where('id',$request->id)->get()->first();
        $message = $comment->text;
        return response()->json(['data'=>$message]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(comment $comment)
    {
        //
    }
}
