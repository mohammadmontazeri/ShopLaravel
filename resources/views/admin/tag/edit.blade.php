@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="box  col-lg-6 col-md-7 col-sm-7 col-xs-9">
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
                <h3 class="box-title">ویرایش برچسب </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
                <form method="POST" action="{{ route('tag.update',['tag' => $tag->id]) }}" enctype="multipart/form-data">
                @csrf
                {{method_field('PATCH')}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">نام برچسب</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" value="{{$tag->name}}" name="name">
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