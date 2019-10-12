@include('layouts.webHeader')
@section('content')
    <div class="container">
        <div class="alert alert-info" style="direction: rtl;text-align: center">
            تمام محتوای آموزشی مربوط به <span>برچسب</span> <span style="font-weight: bold;border-bottom:solid 1px #31708f"> {{$tag}} </span>
        </div>
    <div class="bootstrap-tab animated wow slideInUp" style="float: right"  data-wow-delay=".5s">
        <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
            <ul id="myTab" class="nav nav-tabs" role="tablist"  style="float: right">
                <li role="presentation"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true" style="font-size: 0.9em;font-weight: bold">دوره های اموزشی</a></li>
                <li role="presentation"  class="active"><a  href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" style="font-family:'yekan', sans-serif;font-weight:bold;font-size: 0.9em;"> مقالات</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div style="direction: rtl" role="tabpanel" class="tab-pane fade  bootstrap-tab-text" id="home" aria-labelledby="home-tab">
                        <div class="new-collections">
                            <div class="container">
                                <div class="new-collections-grids" style="direction: rtl">
                                    <?php
                                    $courses = \App\Course::where('tag','like',"%$tag%")->paginate(4);
                                    if (count($courses)==0){
                                        ?>
                                        <div class="alert alert-danger">
                                            دوره ای مرتبط با این برچسب وجود ندارد
                                        </div>
<?php
                                    }
                                    else{
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
                                                    <span style="font-weight: bold;font-size: 0.85em;padding: 5px 8px;" > <i style="color: #bbb" class="fa fa-eye"></i><span style="color: #999"> {{$course->viewed}} </span></span>
                                                    <span style="direction:rtl;color: #fff;border-radius:2px;font-weight: bold;background-color: #595959;padding: 5px 8px;box-sizing: border-box;font-size: 0.9em;">{{$course->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    }
                                    ?>
                                </div>
                            </div>
                            <div style="text-align: center">
                                {{$courses->links()}}
                            </div>
                    </div>
                </div>
                <div style="direction: rtl" role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
                    <div>
                        <div class="new-collections">
                            <div class="container">
                                <div class="new-collections-grids" style="direction: rtl">
                                    <?php
                                    $articles = \App\Article::where('tag','like',"%$tag%")->paginate(4);
                                    if (count($articles)==0){
                                        ?>
                                        <div class="alert alert-danger">
                                            مقاله ای مرتبط با این برچسب وجود ندارد
                                        </div>
<?php
                                    }
                                    else{
                                        foreach ($articles as $article){

                                    ?>
                                    <div class="col-md-3 new-collections-grid">
                                        <div class="new-collections-grid1" data-wow-delay=".5s">
                                            <div class="new-collections-grid1-image" style="height: 150px;">
                                                <a href="{{url(route('articleDetail',['article'=>$article->id]))}}" class=""><img style="border-top-left-radius:2px;border-top-right-radius: 2px; " height="100%" src="{{asset("public$article->image")}}" width="100%"/></a>
                                            </div>
                                            <div style="padding: 0.5em;">
                                                <h4 style="font-family: yekan;font-weight: bold;direction: rtl" class="text-center"><a href="{{url(route('articleDetail',['article'=>$article->id]))}}">{{$article->title}}</a></h4>
                                                <p style="direction: rtl">
                                                    <?php
                                                    $sum = substr($article['summery'],0,100);
                                                    echo $summery = $sum."...";
                                                    ?>
                                                </p>
                                                <div class="new-collections-grid1-left simpleCart_shelfItem" style="display: flex;justify-content: space-between">
                                                    <span style="font-weight: bold;font-size: 0.85em;padding: 5px 8px;" > <i style="color: #bbb" class="fa fa-eye"></i><span style="color: #999"> {{$article->viewed}} </span></span>
                                                    <span style="direction:rtl;color: #fff;border-radius:2px;font-weight: bold;background-color: #595959;padding: 5px 8px;box-sizing: border-box;font-size: 0.9em;">{{$article->price}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    }
                                    ?>
                                </div>

                            </div>
                           <div style="text-align: center">
                               {{$articles->links()}}
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@include('layouts.webFooter')