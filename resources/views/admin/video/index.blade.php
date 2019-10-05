@extends('layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست ویدیو های دوره <span style="background-color: #f0004c;color: #fff;padding: 3px;border-radius: 2px;"> {{$course->title}}  </span> </h3>
                        @if(session('msg'))
                            <label style="color: #fff8f8;background-color: #f0004c;border-radius: 2px;padding: 3px;">{{session('msg')}}</label>
                        @endif
                        <a class="label label-danger pull-left" style="padding: 6px;"  href="{{url(route('video.create',['course'=>$course]))}}">افزودن ویدیو جدید</a>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">

                            <tr style="background-color: #4e555b; color: white">
                                <th>آی دی </th>
                                <th>عنوان</th>
                                {{--<th>تصویر</th>--}}
                                <th>مدت زمان</th>
                                <th>تاریخ ثبت </th>
                                <th>هزینه </th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                                <th>محتوا</th>
                            </tr>
                            <?php
                            foreach ($videos as $video){
                            ?>
                            <tr>
                                <td><?php echo $video['id']; ?></td>
                                <td><?php echo $video['title']; ?></td>
                                <td><?php echo $video->time ;?></td>
                                <td>
                                    <?php
                                    $v = new Verta($video->created_at);
                                    $v = \Hekmatinasser\Verta\Verta::instance($video->created_at);
                                    $v = \Hekmatinasser\Verta\Verta::persianNumbers($v);
                                    echo $v;
                                    ?>
                                </td>
                                <td><?php if ($video->price == null){
                                    echo "<span style='color: red' >رایگان</span>";
                                    }else{
                                    echo "<span style='color: red' >".$video->price."</span>";
                                    } ?></td>
                                <td>
                                    <a class="label label-primary" href="{{url(route('video.edit',['video'=>$video]))}}">ویرایش</a>
                                </td>
                                <td>
                                    <form method="post" action="{{route('video.destroy',['video'=>$video->id])}}">
                                        {{csrf_field()}}
                                        {{method_field('delete')}}
                                        <button class="btn btn-danger">حذف</button>
                                    </form>
                                </td>
                                <td>
                                    <a class="label label-warning" href="{{url(route('videoDetail',['video'=>$video]))}}">محتوای ویدیو</a>
                                </td>
                            </tr>

                            <?php }

                            ?>

                        </table>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->
                {{$videos->links()}}
            </div>
        </div>
    </div>
@endsection