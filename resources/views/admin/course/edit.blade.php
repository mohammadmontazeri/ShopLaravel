@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش اطلاعات دوره</h3>
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
            <form method="POST" action="{{route('course.update',['course'=> $course->id])}}" enctype="multipart/form-data">
                @csrf
                {{method_field('PATCH')}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان</label>
                        <input type="text" class="form-control" name="title"  value="{{$course->title}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">هزینه</label>
                        <input type="text" class="form-control" name="price"  value="{{$course->price}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">دسته بندی را انتخاب کنید</label>

                        <?php
                        $cats = \App\Category::all();
                        echo "<select name='cat_id' id='none'>";
                        foreach ($cats as $cat){
                        ?>
                        <option value="{{$cat->id}}" <?php if ($cat->id == $course->cat_id){echo "selected";} ?>>{{$cat->name}}</option>
                        <?php
                        }
                        echo "</select>";


                        ?>

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">خلاصه متن</label>
                        <input type="text" class="form-control" name="summery" value="{{$course->summery}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">متن محتوا</label>
                        <textarea class="form-control" id="editor1"  name="detail">{{$course->detail}}
                </textarea>
                    </div>
                    <hr>
                    <div class="form-group" style="display: flex">
                        <div style="border-left: solid 1px #ddd;padding-left: 20px">
                            <label for="exampleInputEmail1" style="color: #f0004c"> تگ ها این دوره</label>
                            <?php
                            $tags_ = explode(',',$course->tag);
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
                            $tags_ = explode(',',$course->tag);
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
                        <label for="exampleInputFile">تصویر شاخص</label>
                        <input type="file" id="exampleInputFile" name="image">
                        <img src="{{asset("public/$course->image")}}" alt="" width="75px">
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="btn">ویرایش</button>
                </div>
            </form>
        </div><!-- /.box -->


    </div>

@endsection