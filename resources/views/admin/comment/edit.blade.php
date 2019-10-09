@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
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
                    <div class="card-header">ویرایش کامنت </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('comment.update',['comment'=>$comment->id])}}">
                            @csrf
                            {{method_field('PATCH')}}
                            <div class="form-group row">
                                <div class="col-md-6">
                                <textarea id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="text" required autocomplete="name" autofocus>
                                    {{$comment->text}}
                                </textarea>
                                </div>
                            </div>
                            <label for="">ویرایش وضعیت</label><hr>
                            <label for="">فعال</label>
                            <input type="radio" name="status" <?php if ($comment->status == "1"){echo "checked";} ?> value="1">
                            <label for="">غیر فعال</label>
                            <input type="radio" name="status" value="0" <?php if ($comment->status == "0"){echo "checked";} ?>>
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
            </div>
        </div>
    </div>


@endsection