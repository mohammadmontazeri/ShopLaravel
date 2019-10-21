@include('layouts.webHeader')
@section('content')
    <div class="container">
        <div class="alert alert-info" style="direction: rtl;text-align: center;margin-top: 5%">
            تمام محتوای آموزشی مربوط به <span>جستجو</span> <span style="font-weight: bold;border-bottom:solid 1px #31708f"> {{$query}} </span>
        </div>
        <div class="search-top" style="margin-top: 10%;direction: rtl;border-bottom: solid 2px #cf234f;padding: 10px">
            <ul style="display: flex">
                @if($ar_num != 0)
                    <li style="margin-left: 20px"><a href="{{url(route('search-post',['text'=>$query,'type'=>'article']))}}">مقالات <span>{{$ar_num}}</span> </a></li>
                @else
                    <li style="margin-left: 20px"><a>مقالات <span>{{$ar_num}}</span> </a></li>
                @endif
                @if($co_num != 0)
                        <li style="margin-left: 20px"><a href="{{url(route('search-post',['text'=>$query,'type'=>'course']))}}">دوره های آموزشی <span>{{$co_num}}</span> </a></li>
                @else
                        <li style="margin-left: 20px"><a>دوره های آموزشی <span>{{$co_num}}</span> </a></li>
                @endif
                @if($vid_num != 0)
                        <li style="margin-left: 20px"><a href="{{url(route('search-post',['text'=>$query,'type'=>'video']))}}">ویدیو های آموزشی <span>{{$vid_num}}</span> </a></li>
                @else
                        <li style="margin-left: 20px"><a>ویدیو های آموزشی <span>{{$vid_num}}</span> </a></li>
                @endif
            </ul>
        </div>
        <div class="search-bottom" style="direction: rtl">
            @if(isset($msg))
                <div class="alert alert-danger">
                    {{$msg}}
                </div>
                @else
                <ul>
                    <?php
                    if (!empty($articles)){
                    foreach ($articles as $article){
                    ?>
                    <li style="margin-bottom: 20px;padding: 10px;border-bottom: solid 1px #bbb"><a href="{{url(route('articleDetail',['article'=>$article->id]))}}">{{$article->title}} </a></li>
                    <?php
                    }
                    }elseif (!empty($courses)){
                    foreach ($courses as $course){
                    ?>
                    <li style="margin-bottom: 20px;padding: 10px;border-bottom: solid 1px #bbb"><a href="{{url(route('courseDetail',['course'=>$course->id]))}}">{{$course->title}} </a></li>
                    <?php
                    }
                    }elseif (!empty($videos)){
                    foreach ($videos as $video){
                    ?>
                    <li style="margin-bottom: 20px;padding: 10px;border-bottom: solid 1px #bbb"><a href="{{url(route('videoDetail',['video'=>$video->id]))}}">{{$video->title}} </a></li>
                    <?php
                    }
                    }

                    ?>
                </ul>
            @endif
        </div>
        @if(!empty($articles))
           <?php
            for ($page=1;$page<=$articles->lastPage();$page++){
                echo "<a style='margin-right:5px;' href=".url("search-post?text=$query&type=article&page=$page").">".$page."</a>";
            }
            ?>
        @elseif(!empty($courses))
            <?php
            for ($page=1;$page<=$courses->lastPage();$page++){
                echo "<a style='margin-right:5px;' href=".url("search-post?text=$query&type=course&page=$page").">".$page."</a>";
            }
            ?>
        @elseif(!empty($videos))
            <?php
            for ($page=1;$page<=$videos->lastPage();$page++){
                echo "<a style='margin-right:5px;' href=".url("search-post?text=$query&type=video&page=$page").">".$page."</a>";
            }
            ?>
        @endif
    </div>
@endsection
@include('layouts.webFooter')