@include('layouts.webHeader')
@section('content')
    <div class="breadcrumbs">
    </div>
    <!-- //breadcrumbs -->
    <!-- single -->
    <?php
    $cats = \App\Category::all();
    $tags = explode(',',$article->tag);
    $comments = $article->comments()->orderBy('id','DESC')->get();
    $num = count($comments->where('status','1'));
    // add viewed
    $viewed = $article->viewed + 1;
    $article->update(['viewed'=>$viewed]);
    ?>
    <div class="single">
        <div class="container">
            <div class="col-md-4 single-left">
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
                        <h3 style="font-family: yekan;font-weight: bolder;color: #595959">{{$article->title}}</h3>
                    </div>
                    <div class="description">
                        <h5 style="font-family: yekan;font-weight: bold">توضیحات</h5>
                        <p style="direction: rtl">{{$article->summery}}</p>
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
                            <li role="presentation"><a  href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" style="font-family:yekan;font-weight:bold;font-size: 0.9em;"> نظرات(<span style="color:#f0004c;font-weight:bold;padding: 3px;font-family: 'yekan', sans-serif">{{$num}}</span>) </a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
                                <p style="direction: rtl;margin-top: 20px;padding: 10px;line-height: 35px">
                                        {!! $article->detail !!}
                                </p>
                            </div>
                            <div style="direction: rtl" role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
                               @if(\Illuminate\Support\Facades\Auth::check())
                                    <section class="comment_part">
                                        <div class="type_cmnt">
                                            <div class="alert alert-danger reply" role="alert">
                                                 پاسخ به   <span style="font-weight: bold;text-decoration-style:solid;text-decoration-color: #a94442 ;" class="show-reply">  </span>
                                            </div>
                                            <div class="typing_part">
                                                    <textarea name="text" id="text" style="font-size:.9em;padding:7px;width: 100%;border: solid 2px #ddd;height: 175px;border-radius: 2px;" placeholder="در مورد این پست دیدگاهی داری..."></textarea>
                                                    <button data-content="{{Auth()->user()->id}}" data-type="article" data-test="{{$article->id}}"  class="btn_comment iran" style="font-family: yekan">
                                                        ارسال دیدگاه
                                                    </button>
                                            </div>
                                            <div class="all_comment" id="tab">
                                                <?php
                                                function parent($parent, $article_id)
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
                                                        parent($par['id'], $article_id);
                                                    }
                                                }
                                                }
                                                }
                                                function ch($comments, $article)
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
                                                parent($item['id'], $article['id']);
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
                                                ch($comments,$article);

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
            <h4  style="color: #111;padding: 10px;font-weight: bolder"  class="text-center">مقالات آموزشی پیشنهادی </h4>
            <div class="new-collections-grids" style="direction: rtl">
                <?php
                $articles = \App\Article::all()->random(4);
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
                                        echo \App\Category::where('id',$article->cat_id)->get()->first()->name;
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
@endsection
@include('layouts.webFooter')