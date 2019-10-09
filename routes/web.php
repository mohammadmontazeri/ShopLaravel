<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*Route::get('/teest',function (){
    $comment = \App\Comment::where('id',12)->get()->first();
    $message = $comment->text;
    return $message;
});*/

//Auth::routes();
Route::prefix('admin')->group(function (){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', function (){
        \Illuminate\Support\Facades\Auth::logout();
        return back()->with('msg','شما با موفقیت خارج شده اید');
    })->name('logout');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});
Route::prefix('admin')->middleware('auth')->group(function (){

    Route::get('/',function (){
       return view('admin.home');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/user','Admin\UserController');
    Route::resource('/category','Admin\CategoryController');
    Route::resource('/tag','Admin\TagController');
    Route::resource('/article','Admin\ArticleController');
    Route::get('/article/{article}',function (\App\Article $article){
        return view('admin.article.detail',compact('article'));
    })->name('articleDetail');
    Route::post('upload-ckEditor','Admin\ArticleController@upload')->name('upload-editor');
    Route::resource('/course','Admin\CourseController');
    Route::resource('/video','Admin\VideoController');
    Route::get('/video/{video}',function (\App\Video $video){
        return view('admin.video.detail',compact('video'));
    })->name('videoDetail');
    Route::resource('/newsletter','NewsletterController');
    Route::resource('/contact','ContactController');
    Route::resource('/comment','Admin\CommentController');
    Route::get('reply/{comment}','Admin\CommentController@reply')->name('replyComment');
    Route::post('reply/{comment}','Admin\CommentController@replyPost')->name('replyCommentPost');

});
Route::post('/ajax-delete','Admin\AdminController@ajax')->name('ajax');
//=============================End Admin Route & Start User Route===============================================//
Route::get('/',function (){
    return view('home');
})->name('home');
Route::get('login',function (){
    return view('login');
})->name('UserLogin');
Route::post('login','Auth\LoginController@authenticate')->name('LoginPostUser');
Route::get('register',function (){
    return view('register');
})->name('UserRegister');
Route::post('/newsletter/store','NewsletterController@store')->name('newsletterStore');
Route::get('/contact-us',function (){
    return view('contact.contact');
})->name('contact');
Route::post('/contact','ContactController@store')->name('contactStore');

Route::get('course/{course}',function (\App\Course $course){
   return view('course.detail',compact('course'));
})->name('courseDetail');
Route::get('/comment/create','CommentController@store')->name('addCommentFromUser');
Route::get('/comment/reply','CommentController@reply')->name('replyCommentUser');
//Route::resource('/course','CourseController');

