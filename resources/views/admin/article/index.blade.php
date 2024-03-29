@extends('layouts.admin')

@section('content')
        <div class="container">

            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">لیست همه مقاله ها</h3>
                            @if(session('msg'))
                                <label style="color: #f0004c">{{session('msg')}}</label>
                            @endif
                            <a class="label label-warning" href="{{url(route('article.create'))}}" style="float: left;padding: 7px;">افزودن مقاله جدید</a>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">

                                <tr style="background-color: #4e555b; color: white">
                                    <th>آی دی </th>
                                    <th>عنوان</th>
                                    <th>خلاصه</th>
                                    <th>تاریخ ثبت </th>
                                    <th>دسته بندی</th>
                                    <th>محتوای مقاله</th>
                                    <th>ویرایش</th>
                                    <th>حذف</th>
                                </tr>
                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{$article->id}}</td>
                                        <td>{{$article->title}}</td>
                                        <td>
                                            <?php
                                            $sum = substr($article['summery'],0,20);
                                            echo $summery = $sum."...";
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $v = new Verta($article->created_at);
                                            $v = \Hekmatinasser\Verta\Verta::instance($article->created_at);
                                            $v = \Hekmatinasser\Verta\Verta::persianNumbers($v);
                                            echo $v;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $cat = \App\Category::where('id','=',$article->cat_id)->first();
                                            echo $cat->name;
                                            ?>
                                        </td>
                                        <td><a class="label label-info" href="{{route('articleDetail',['detail' => $article])}}">محتوای مقاله</a></td>
                                        <td>
                                            <a class="label label-primary" href="{{url(route('article.edit',['article'=>$article->id]))}}">ویرایش</a>
                                        </td>
                                        <td>
                                            <button data-test="{{$article->id}}" data-content="article" class="btn btn-danger delete">حذف</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    {{$articles->links()}}
                </div>
            </div>

        </div>
@endsection