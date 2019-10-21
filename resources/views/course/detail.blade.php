@include('layouts.webHeader')
@section('content')
    <div class="breadcrumbs">
    </div>
    <!-- //breadcrumbs -->
    <!-- single -->
    <?php
    $cats = \App\Category::all();
    $tags = explode(',',$course->tag);
    $comments = $course->comments()->orderBy('id','DESC')->where('episode_id',null)->get();
    $num = count($comments->where('status','1'));
    // add viewed
    $viewed = $course->viewed + 1;
    $course->update(['viewed'=>$viewed]);
    ?>
    <div class="single">
        <div class="container">
            <div class="col-md-4 single-left">
                <div style="background-color: #cf294f;width: 100%;height: auto;text-align: center;border-radius: 2.5px">
                   @if($course->price != 'رایگان')
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <a href="#" style="display: block;font-size: 1.1em;color: white;padding: 20px 20px" data-toggle="modal" data-target="#exampleModal">پرداخت هزینه برای شرکت در دوره</a>
                        @else
                            <a href="{{url(route('UserLogin'))}}" style="display: block;font-size: .9em;color: white;padding: 20px 20px">برای شرکت در این دوره ابتدا باید وارد سایت شوید</a>
                        @endif
                   @endif
                </div>
                <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color: white !important;height: 300px !important">
                            <div style="background-color: #5a6268;padding: 10px 5px !important;height: 50px;direction: rtl">
                                <button style="" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" ><i style="color: white !important;" class="fa fa-times-circle"></i></span>
                                </button>
                                <span style="color: #fff;font-size: .9em;font-weight: bold;margin-right: 35%">خرید : <span>{{$course->title}}</span></span>
                            </div>
                            <form action="{{route('payment.store')}}" method="post">
                                @csrf
                                <div style="height: 120px;padding: 40px 30px">
                                    <div style="padding: 5px 10px;display: flex;direction: rtl;justify-content: space-between;border: solid 1px #d0d0d0;border-radius: 2px">
                                        <span style="font-size: .9em;padding:5px 7px;font-weight: bold ">مبلغ پرداختی</span>
                                        <span style="padding: 5px 7px;color: #4cae4c;border-radius: 2px;font-weight: bold">{{$course->price}}</span>
                                    </div>
                                </div>
                                <input type="hidden" name="course_id" value="{{$course->id}}">
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                                    @endif
                                <div style="height: 80px;direction: rtl;text-align: center;padding: 15px;border-top:solid 1px #e0e0e0;width: 98%;margin: auto ">
                                    <button name="btn" style="color: white;border: solid 1px #d0d0d0;width: 97%;padding: 15px 0px;border-radius: 3px;background-color: #cf234f;font-size: .9em">
                                        خرید از درگاه
                                    </button>
                                </div>
                            </form>
                            <div style="background-color: #14648f;height: 50px;padding: 7px;text-align: center">
                                <span style="font-size: .75em;color: #fff;">با پرداخت وجه از درگاه پرداخت معتبر از خرید خود اطمینان حاصل کنید</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="categories animated wow slideInUp" data-wow-delay=".5s">
                    <h4 style="font-family: yekan;font-weight: bolder;text-align: center;padding: 20px 0px;background-color: #eee">دسته بندی ها</h4>
                    <ul class="cate" style="direction: rtl">
                        @foreach($cats as $cat)
                        <li style="direction: ltr"><a href="{{url(route('catIndex',['category'=>$cat->id]))}}">{{$cat->name}}</a></li>
                            @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-8 single-right">
                <div class="col-md-12 single-right-left animated wow slideInUp" data-wow-delay=".5s">
                    <div class="flexslider">
                        <img src="{{asset('public/images/124.jpg')}}" alt="" width="100%" style="border: solid 2px #888;border-radius: 2px;">
                    </div>
                </div>
                <div style="direction: rtl" class="col-md-12 single-right-left simpleCart_shelfItem animated wow slideInRight" data-wow-delay=".5s">
                    <div style="padding-top:10px;display: flex;justify-content: space-between">
                        <h3 style="font-family: yekan;font-weight: bolder;color: #595959">{{$course->title}}</h3>
                        <span style=";font-size:0.85em;font-weight: bold;color: #fff;background-color:#3a87ad;padding: 7px 12px;border: solid 1.5px #d0d0d0;border-radius: 3px;">{{$course->price}}</span>
                    </div>
                    <div class="description">
                        <h5 style="font-family: yekan;font-weight: bold">توضیحات</h5>
                        <p style="direction: rtl">{{$course->summery}}</p>
                    </div>
                    <div class="occasional">
                        <div class="clearfix"> </div>
                    </div>
                    <div class="social">
                        <h5 style="font-weight: bold;padding-bottom: 10px;">برچسب ها</h5>
                        <ul style="display: flex;font-size: 0.8em;font-weight: bold;color: #8a8a8a">
                            @foreach($tags as $tag)
                            <li style="margin-left: 8px;"><a href="{{url(route('tagIndex',['tag'=>$tag]))}}">#{{$tag}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="clearfix"> </div>
                <div class="bootstrap-tab animated wow slideInUp"  data-wow-delay=".5s">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true" style="font-size: 0.9em;font-weight: bold">توضیحات کامل</a></li>
                            <li role="presentation"><a href="#video" id="video-tab" role="tab" data-toggle="tab" aria-controls="video" aria-expanded="true" style="font-size: 0.9em;font-weight: bold">جلسات دوره</a></li>
                            <li role="presentation"><a  href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" style="font-family:yekan;font-weight:bold;font-size: 0.9em;"> نظرات(<span style="color:#f0004c;font-weight:bold;padding: 3px;font-family: 'yekan', sans-serif">{{$num}}</span>) </a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
                                <p style="direction: rtl;margin-top: 20px;padding: 10px;line-height: 35px">
                                        {!! $course->detail !!}
                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="video" aria-labelledby="video-tab">
                                    <?php
                                    $videos = $course->videos;
                                foreach ($videos as $video){
                                 ?>
                                        <div style="direction:rtl;background-color: #f6f6f6;border: solid 1.2px #ddd;border-radius: 2px;padding: 10px;display: flex;justify-content: space-between;margin-bottom: 5px">
                                            <div class="right-item">
                                                <span style="color:#fff;font-size: 1em;font-weight: bold;background-color: #3a87ad;display:inline-block;text-align:center;width: 20px;border-radius: 50%;border: solid 1.5px #d0d0d0">{{$video->id}}</span>
                                                <a href="{{url(route('videoDetail',['video'=>$video->id]))}}" style="font-size: .85em;color: #5a6268;font-weight: bold" >{{$video->title}}</a>
                                            </div>
                                            <div class="left-item">
                                                @if($video->price == "رایگان")
                                                    <a class="download" href="#" style="margin-left: 5px;color: #5a6268"><i class="fa fa-download"></i></a>
                                                @endif
                                                <span style="font-size: .9em;color: #f0004c;">{{$video->time}}</span>
                                            </div>
                                        </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div style="direction: rtl" role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
                               @if(\Illuminate\Support\Facades\Auth::check())
                                    <section class="comment_part">
                                        <div class="type_cmnt">
                                            <div class="alert alert-danger reply" role="alert">
                                                 پاسخ به   <span style="font-weight: bold;text-decoration-style:solid;text-decoration-color: #a94442 ;" class="show-reply">  </span>
                                            </div>
                                            <div class="typing_part">
                                                    <textarea name="text" id="text" style="padding:7px;width: 100%;border: solid 2px #ddd;height: 175px;border-radius: 2px;" placeholder="در مورد این پست دیدگاهی داری..."></textarea>
                                                    <button data-content="{{Auth()->user()->id}}" data-type="course" data-test="{{$course->id}}" data-for=""  class="btn_comment iran" style="font-family: yekan">
                                                        ارسال دیدگاه
                                                    </button>
                                            </div>
                                            <div class="all_comment">
                                                <?php
                                                function parent($parent, $course_id)
                                                {
                                                     $parents = \App\Comment::where('parent',$parent)->get();
                                                     foreach ($parents as $par) {
                                                        if ($par['status'] == "1"){
                                                ?>
                                                <ul>
                                                    <div style="margin-bottom: 5px;" class="cmt_answer">
                                                        <div class="user_inf">
                                                            <div>
                                                                <img src="{{asset('public/images/2.jpg')}}" alt="">
                                                            </div>
                                                            <div class="user_cmt">
                                                                <a href="#"> <?php
                                                                    $user = \App\User::where('id',$par->user_id)->get()->first();
                                                                    echo $user->name;
                                                                    ?></a>
                                                                <span class="time_cmt"><?php
                                                                    $v = new Verta($par->created_at);
                                                                    $v = \Hekmatinasser\Verta\Verta::instance($par->created_at);
                                                                    $v = \Hekmatinasser\Verta\Verta::persianNumbers($v);
                                                                    echo $v;
                                                                    ?></span>
                                                            </div>
                                                            <div class="answer_this">
                                                                <a style="cursor: pointer">
                                                                    <i class="fa fa-reply" aria-hidden="true" data-number="{{$par->id}}"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="content">
                                                            <p>
                                                                {{$par->text}}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </ul>
                                                <?php
                                                    if ($par['is_parent'] == "1") {
                                                        parent($par['id'], $course_id);
                                                    }
                                                }
                                                }
                                                }
                                                function ch($comments, $course)
                                                {
                                                echo "<ul>";
                                                foreach ($comments as $key => $item) {
                                                if (($item['parent'] == "") && ($item['is_parent'] == "1") && ($item['status'] == "1")) {
                                                ?>
                                                <li>
                                                    <div class="cmt_orgn">
                                                        <div class="cmt_question">
                                                            <div class="user_inf">
                                                                <div>
                                                                    <img src="{{asset('public/images/1.jpg')}}" alt="">
                                                                </div>
                                                                <div class="user_cmt">
                                                                    <a href="#">
                                                                        <?php
                                                                        $user = \App\User::where('id',$item->user_id)->get()->first();
                                                                        echo $user->name;
                                                                        ?>
                                                                    </a>
                                                                    <span class="time_cmt"><?php
                                                                        $v = new Verta($item->created_at);
                                                                        $v = \Hekmatinasser\Verta\Verta::instance($item->created_at);
                                                                        $v = \Hekmatinasser\Verta\Verta::persianNumbers($v);
                                                                        echo $v;
                                                                        ?></span>
                                                                </div>
                                                                <div class="answer_this">
                                                                    <a style="cursor: pointer">
                                                                        <i class="fa fa-reply" aria-hidden="true" data-number="{{$item->id}}"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <p>
                                                                    {{$item->text}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                <?php
                                                parent($item['id'], $course['id']);
                                                ?>
                                                    </div>
                                                </li>
                                                    <?php
                                                }
                                                if (($item['parent'] == "") && ($item['is_parent'] == "0") && ($item['status'] == "1")) {
                                                ?>
                                                <li>
                                                    <div class="cmt_orgn">
                                                        <div class="cmt_question">
                                                            <div class="user_inf">
                                                                <div>
                                                                    <img src="{{asset('public/images/1.jpg')}}" alt="">
                                                                </div>
                                                                <div class="user_cmt">
                                                                    <a href="#">
                                                                        <?php
                                                                        $user = \App\User::where('id',$item->user_id)->get()->first();
                                                                        echo $user->name;
                                                                        ?>
                                                                    </a>
                                                                    <span class="time_cmt"><?php
                                                                        $v = new Verta($item->created_at);
                                                                        $v = \Hekmatinasser\Verta\Verta::instance($item->created_at);
                                                                        $v = \Hekmatinasser\Verta\Verta::persianNumbers($v);
                                                                        echo $v;
                                                                        ?></span>
                                                                </div>
                                                                <div class="answer_this">
                                                                    <a style="cursor: pointer">
                                                                        <i class="fa fa-reply" aria-hidden="true" data-number="{{$item->id}}"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="content">
                                                                <p>
                                                                    {{$item->text}}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                                }
                                                }
                                                echo "</ul>";
                                                }
                                                ch($comments,$course);

                                                ?>
                                            </div>
                                        </div>
                                    </section>
                                   @else
                                    <div class="alert alert-danger" role="alert">
                                      برای مشاهده نظرات و ثبت نظر لطفا ابتدا وارد سایت شوید
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <!-- //single -->
    <!-- single-related-products -->
    <div class="new-collections">
        <div class="container">
            <h4  style="color: #111;padding: 10px;font-weight: bolder"  class="text-center">دوره های آموزشی پیشنهادی </h4>
            <div class="new-collections-grids" style="">
                <?php
                $courses = \App\Course::all()->random(4);
                foreach ($courses as $course){
                ?>
                <div class="col-md-3 new-collections-grid">
                    <div class="new-collections-grid1" data-wow-delay=".5s">
                        <div class="new-collections-grid1-image" style="height: 150px;">
                            <a href="{{url(route('courseDetail',['course'=>$course->id]))}}" class=""><img style="border-top-left-radius:2px;border-top-right-radius: 2px; " height="100%" src="{{asset("public$course->image")}}" width="100%"/></a>
                        </div>
                        <div style="padding: 0.5em;">
                            <h4 style="font-family: yekan;font-weight: bold;direction: rtl" class="text-center"><a href="{{url(route('courseDetail',['course'=>$course->id]))}}">{{$course->title}}</a></h4>
                            <p style="direction: rtl">
                                <?php
                                $sum = substr($course['summery'],0,100);
                                echo $summery = $sum."...";
                                ?>
                            </p>
                            <div class="new-collections-grid1-left simpleCart_shelfItem" style="display: flex;justify-content: space-between">
                                <span style="font-weight: bold;font-size: 0.85em;padding: 5px 8px;" > <i style="color: #bbb" class="fa fa-ear"></i><span style="color: #999"> {{$course->viewed}} </span></span>
                                <span style="direction:rtl;color: #fff;border-radius:2px;font-weight: bold;background-color: #595959;padding: 5px 8px;box-sizing: border-box;font-size: 0.9em;">{{$course->price}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
@endsection
@include('layouts.webFooter')