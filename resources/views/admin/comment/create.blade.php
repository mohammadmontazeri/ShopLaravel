@extends('layouts.admin')

@section('content')
    @if(session('msg'))
        <label style="color: #f0004c">{{session('msg')}}</label>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="list-style-type: none">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <h3 style="padding: 10px;">ایجاد کامنت جدید</h3>
        <div class="col-md-6" style="border: solid 2px #aaa">
            <h4 style="padding-bottom: 20px;border-bottom: solid 2px #eee">ثبت کامنت برای دوره ها</h4>
            <form method="POST" action="{{route('comment.store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">دوره مورد نظر  را انتخاب کنید</label>
                    <select name="course_id" id="">
                        <?php
                        $courses = \App\Course::all();
                        foreach ($courses as $course){
                        ?>
                        <option value="<?php echo $course->id;?>"><?php echo $course->title;?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <textarea id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="text" required autocomplete="name" autofocus>
                        </textarea>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" name="btn">
                            ثبت
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6" style="border: solid 2px #aaa;border-right: none">
            <h4 style="padding-bottom: 20px;border-bottom: solid 2px #eee">ثبت کامنت برای مقالات</h4>
            <form method="POST" action="{{route('comment.store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">مقاله مورد نظر  را انتخاب کنید</label>
                    <select name="article_id" id="">
                        <?php
                        $articles = \App\Article::all();
                        foreach ($articles as $article){
                        ?>
                        <option value="<?php echo $article->id;?>"><?php echo $article->title;?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <textarea id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="text" required autocomplete="name" autofocus>
                        </textarea>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" name="btn">
                            ثبت
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection