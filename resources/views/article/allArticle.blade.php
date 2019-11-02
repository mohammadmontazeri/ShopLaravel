@include('layouts.webHeader')
@section('content')
    <div class="new-collections">
        <div class="container">
            <h4  style="color: #111;padding: 10px;font-weight: bolder"  class="text-center">همه مقالات آموزشی </h4>
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
        {{$articles->links()}}
    </div>

@endsection
@include('layouts.webSidebar')

@include('layouts.webFooter')