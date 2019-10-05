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

Route::get('/', function () {
    \Illuminate\Support\Facades\Auth::loginUsingId(1);
});

//Auth::routes();
Route::prefix('admin')->group(function (){
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::get('logout', function (){
        \Illuminate\Support\Facades\Auth::logout();
        return redirect(route('login'))->with('msg','شما با موفقیت خارج شده اید');
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
    Route::resource('/comment','Admin\CommentController');

});
