@include('layouts.webHeader')
@section('content')
    <!-- //banner-bottom -->
    <!-- collections -->
    <style>
        body{
            font-family: yekan;
        }
    </style>
    <?php
    $courses = \App\Course::latest()->paginate(4);
    $articles = \App\Article::latest()->paginate(4);
    ?>
    <div class="new-collections">
        <div class="container">
            <h4  style="color: #111;padding: 10px;font-weight: bolder"  class="text-center">آخرین دوره های آموزشی </h4>
            <p style="border-bottom: #bbb" class="est animated wow zoomIn" data-wow-delay=".5s">شما میتوانید از بخش زیر به آخرین محصولات سایت دسترسی داشته باشید</p>
            <div class="new-collections-grids">
                <?php
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
                                <span style="font-weight: bold;font-size: 0.85em;padding: 5px 8px;" > <i style="color: #bbb" class="fa fa-eye"></i><span style="color: #999;font-family: 'yekan', sans-serif"> {{$course->viewed}} </span></span>
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
    <!-- //collections -->
    <!-- new-timer -->
    <div class="new-collections">
        <div class="container">
            <h4  style="color: #111;padding: 10px;font-weight: bolder"  class="text-center">آخرین مقالات آموزشی </h4>
            <p style="border-bottom: #bbb" class="est animated wow zoomIn" data-wow-delay=".5s">شما میتوانید از بخش زیر به آخرین محصولات سایت دسترسی داشته باشید</p>
            <div class="new-collections-grids">
                <?php
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
                                    <span style="direction:rtl;color: #fff;border-radius:2px;font-weight: bold;background-color: #595959;padding: 5px 8px;box-sizing: border-box;font-size: 0.9em;">
                                        <?php
                                        $cat = \App\Category::where('id',$article->cat_id)->get()->first();
                                        echo $cat->name;
                                        ?>
                                    </span>
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
    <!-- //new-timer -->
    <!-- collections-bottom -->
    <div class="collections-bottom">
        <div class="container">
            <div class="collections-bottom-grids">
                <div class="collections-bottom-grid animated wow slideInLeft" style="direction: rtl" data-wow-delay=".5s">
                    <h3 style="font-family: yekan;direction: rtl">۴۵ درصد تخفیف<a href="#" style="display:block;color: #31708f;font-size: 0.9em;">دوره آموزش ویو جی اس </a></h3>
                </div>
            </div>
            @if(session('newsMsg'))
                <label for="" style="background-color: #f0004c;color: #fff;padding: 5px;box-sizing: border-box;border-radius: 2.5px;">{{session('newsMsg')}}</label>
            @endif
            @if ($errors->any())
                <label for="" style="background-color: #f0004c;color: #fff;padding: 5px;box-sizing: border-box;border-radius: 2.5px;">ایمیل شما قبلا برای دریافت خبرنامه ثبت شده است</label>
            @endif
            <div class="newsletter animated wow slideInUp" data-wow-delay=".5s">
                <h3 style="font-family: yekan">خبرنامه</h3>
                <p>با عضویت در خبرنامه سایت از جدیدترین رویداد ها مطلع گردید</p>
                <form method="POST" action="{{route('newsletterStore')}}">
                    @csrf
                    <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
                    <input type="email" name="email" style="font-family: yekan,Verdana, Arial, sans-serif" value="آدرس ایمیل خود را وارد کنید" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'آدرس ایمیل خود را وارد کنید';}" required="">
                    <input type="submit" value="عضویت" style="font-family: yekan;border-radius: 2px" >
                </form>
            </div>
        </div>
    </div>
@endsection
@include('layouts.webSidebar')

@include('layouts.webFooter')