@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش ویدیو</h3>
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
            </div><!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{route('video.update',['video'=>$video])}}" enctype="multipart/form-data">
                @csrf
                {{method_field('PATCH')}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان ویدیو</label>
                        <input type="text" class="form-control" name="title" value="{{$video->title}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">هزینه این ویدیو</label>
                        <input type="text" class="form-control" name="price"   value="{{$video->price}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">مدت زمان این ویدیو</label>
                        <input type="text" class="form-control" name="time"  value="{{$video->time}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">خلاصه متن</label>
                        <input type="text" class="form-control" name="summery" value="{{$video->summery}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">متن محتوا</label>
                        <textarea class="form-control" id="editor1"  name="detail">{{$video->detail}}
                </textarea>
                    </div>
                    <hr>
                    <div class="form-group" style="display: flex">
                        <div style="border-left: solid 1px #ddd;padding-left: 20px">
                            <label for="exampleInputEmail1" style="color: #f0004c"> تگ ها این ویدیو</label>
                            <?php
                            $tags_ = explode(',',$video->tag);
                            $num = count($tags_);
                            foreach ($tags_ as $tag){
                            ?>
                            <div class="form-check">
                                <label class="form-check-label" for="defaultCheck1">
                                    {{$tag}}
                                </label>
                            </div>

                            <?php
                            }
                            ?>
                        </div>
                        <div style="padding-right: 20px;">
                            <label for="exampleInputEmail1" style="color: #f0004c"> کلیه تگ ها</label>
                            <?php
                            $tags = \App\Tag::all();
                            $tags_ = explode(',',$video->tag);
                            $num = count($tags_);
                            foreach ($tags as $tag){
                            ?>
                            <div class="form-check">
                                <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->name}}" id="defaultCheck1" multiple>
                                <label class="form-check-label" for="defaultCheck1">
                                    {{$tag->name}}
                                </label>
                            </div>

                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputFile">ویرایش فایل ویدیو</label>
                        <input type="file" id="exampleInputFile" name="url">
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="btn">ویرایش</button>
                </div>
            </form>
        </div><!-- /.box -->

    </div>


@endsection