@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="box box-primary">
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
            <div class="box-header with-border">
                <h3 class="box-title">ویرایش دسته </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                <form method="POST" action="{{ route('category.update',['category' => $category->id]) }}" enctype="multipart/form-data">
                @csrf
                {{method_field('PATCH')}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">نام دسته</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" value="{{$category->name}}" name="name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">تصویر</label>
                        <input type="file" id="exampleInputFile" name="image">
                        <img src="{{asset("public/$category->image")}}" alt="" width="75px">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">ثبت</button>
                </div>
            </form>
        </div>
    </div>


@endsection