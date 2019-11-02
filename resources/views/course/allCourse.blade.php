@include('layouts.webHeader')
@section('content')

<div class="new-collections">
    <div class="container">
        <h4  style=";color: #505050;padding: 15px 0px;font-weight: bolder;text-align: right;border-bottom: solid 1px #f0f0f0">همه دوره های آموزشی </h4>
        <div class="new-collections-grids" style="padding-top: 15px ">
            <?php
            foreach ($courses as $course){
            ?>
            <div class="col-md-3 new-collections-grid">
                <div class="new-collections-grid1" data-wow-delay=".5s">
                    <div class="new-collections-grid1-image" style="height: 150px;">
                        <a href="{{url(route('courseDetail',['course'=>$course->id]))}}" class=""><img style="border-top-left-radius:2px;border-top-right-radius: 2px; " height="100%" src="{{asset("public$course->image")}}" width="100%"/></a>
                    </div>
                    <div style="padding: 0.5em;">
                        <h4 style="font-family: yekan;font-weight: bold;direction: rtl;color:#505050 !important;" class="text-center"><a href="{{url(route('courseDetail',['course'=>$course->id]))}}">{{$course->title}}</a></h4>
                        <p style="direction: rtl;font-size: .75em !important;">
                            <?php
                            $sum = substr($course['summery'],0,100);
                            echo $summery = $sum."...";
                            ?>
                        </p>
                        <div class="new-collections-grid1-left simpleCart_shelfItem" style="display: flex;justify-content: space-between">
                            <span style="font-weight: bold;font-size: 0.85em;padding: 5px 8px;" > <i style="color: #bbb" class="fa fa-eye"></i><span style="color: #999;font-family: 'yekan', sans-serif"> {{$course->viewed}} </span></span>
                            <span style="direction:rtl;color: #fff;border-radius:2px;font-weight: bold;background-color: #79aace;padding: 5px 8px;box-sizing: border-box;font-size: 0.8em;">{{$course->price}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    {{$courses->links()}}
</div>


@endsection
@include('layouts.webSidebar')

@include('layouts.webFooter')