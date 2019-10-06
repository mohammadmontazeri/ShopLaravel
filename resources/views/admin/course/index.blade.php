@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">لیست دوره های ویدیویی </h3>
                        @if(session('msg'))
                            <label style="color: #fff8f8;background-color: #f0004c;border-radius: 2px;padding: 3px;">{{session('msg')}}</label>
                        @endif
                        <a class="label label-danger pull-left" style="padding: 6px;"  href="{{url(route('course.create'))}}">افزودن دوره جدید</a>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">

                            <tr style="background-color: #4e555b; color: white">
                                <th>آی دی </th>
                                <th>عنوان</th>
                                <th>تصویر</th>
                                <th>تاریخ ثبت </th>
                                <th>هزینه </th>
                                <th>ویرایش</th>
                                <th>حذف</th>
                                <th>ویدیو ها</th>
                            </tr>
                            <?php
                            foreach ($courses as $course){
                            ?>
                            <tr>
                                <td><?php echo $course['id']; ?></td>
                                <td><?php echo $course['title']; ?></td>
                                <td>
                                    <img src="{{asset("public/$course[image]")}}" alt="" width="75px">
                                </td>
                                <td>
                                    <?php
                                    $v = new Verta($course->created_at);
                                    $v = \Hekmatinasser\Verta\Verta::instance($course->created_at);
                                    $v = \Hekmatinasser\Verta\Verta::persianNumbers($v);
                                    echo $v;
                                    ?>
                                </td>
                                <td><?php if ($course->price == null){
                                    echo "<span style='color: red' >رایگان</span>";
                                    }else{
                                    echo "<span style='color: red' >".$course->price."</span>";
                                    } ?></td>
                                <td>
                                    <a class="label label-primary" href="{{url(route('course.edit',['course'=>$course]))}}">ویرایش</a>
                                </td>
                                <td>
                                    <button data-test="{{$course->id}}" data-content="course" class="btn btn-danger delete">حذف</button>

                                </td>
                                <td>
                                    <a class="text-danger text-bold" href="{{url(route('video.index',['courseTitle'=>$course->title]))}}">افزودن<span class="label label-info rounded-circle mr-2">
                                        <?php
                                            $videos = \App\Video::where('course_id',$course->id)->get();
                                            $num = count($videos);
                                            echo $num;
                                        ?>
                                        </span></a>
                                </td>
                            </tr>

                            <?php }

                            ?>

                        </table>
                    </div><!-- /.box-body -->

                </div><!-- /.box -->
                {{$courses->links()}}
            </div>
        </div>
    </div>
@endsection