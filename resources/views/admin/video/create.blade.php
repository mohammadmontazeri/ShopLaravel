@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">افزودن ویدیو جدید</h3>
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
            <form method="POST" action="{{route('video.store',['course'=>$course])}}" enctype="multipart/form-data">
                @csrf
                {{method_field('POST')}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان ویدیو</label>
                        <input type="text" class="form-control" name="title"   placeholder="عنوان را وارد کنید">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">هزینه این ویدیو</label>
                        <input type="text" class="form-control" name="price"   placeholder=" مبلغ هزینه را وارد کنید">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">مدت زمان این ویدیو</label>
                        <input type="text" class="form-control" name="time"   placeholder=" زمان را وارد کنید">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">خلاصه متن</label>
                        <input type="text" class="form-control" name="summery" placeholder="خلاصه متن را وارد کنید">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">متن محتوا</label>
                        <textarea class="form-control" id="editor1"  name="detail">
                </textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputEmail1">تگ ها</label>
                        <?php
                        $tags = \App\Tag::all();
                        foreach ($tags as $tag){
                        ?>
                        <div class="form-check">
                            <input class="form-check-input" name="tag[]" type="checkbox" value="{{$tag->name}}" id="defaultCheck1" >
                            <label class="form-check-label" for="defaultCheck1">
                                {{$tag->name}}
                            </label>
                        </div>

                        <?php
                        }
                        ?>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleInputFile">آپلود ویدیو</label>
                        <input type="file" id="exampleInputFile" name="url">
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="btn">افزودن</button>
                </div>
            </form>
        </div><!-- /.box -->

    </div>


@endsection