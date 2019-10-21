@yield('content')
<div class="footer" style="direction: rtl">
    <div class="container" style="direction: rtl">
        <div class="footer-grids" style="direction: rtl">
            <div class="col-md-4 footer-grid animated wow slideInLeft" data-wow-delay=".5s">
                <h3 style="font-family: yekan;direction: rtl">درباره ما</h3>
                <p style="direction: rtl">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. </p>
            </div>
            <div class="col-md-4 footer-grid animated wow slideInLeft" data-wow-delay=".6s">
                <h3 style="font-family: yekan">راه های ارتباط با ما</h3>
                <ul>
                    <li><i class="glyphicon glyphicon-map-marker" aria-hidden="true" style="color: #f0004c"></i>مازندران</li>
                    <li><i class="glyphicon glyphicon-envelope" aria-hidden="true" style="color: #f0004c;"></i><a style="font-family: Verdana, Arial, sans-serif" href="mailto:info@example.com"> Montazeriput95@gmail.com </a></li>
                    <li><i class="glyphicon glyphicon-earphone" aria-hidden="true" style="color: #f0004c"></i> ۰۹۱۱۷۱۳۲۲۰۵ </li>
                </ul>
            </div>
            <div class="col-md-4 footer-grid animated wow slideInLeft" data-wow-delay=".6s">
                <h3 style="font-family: yekan">دوره های پیشنهادی</h3>
                <ul>
                    <?php
                    $viewCourses = \App\Course::all()->random(4);
                    foreach ($viewCourses as $viewCourse){
                    ?>
                    <li><a href="{{url(route('courseDetail',['course'=>$viewCourse->id]))}}">{{$viewCourse->title}}</a></li>
                    <?php
                        }
                        ?>
                </ul>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="footer-logo animated wow slideInUp" data-wow-delay=".5s">
            <h2><a href="index.html">Best Store <span style="color: #f0004c">shop anywhere</span></a></h2>
        </div>
        <div class="copy-right animated wow slideInUp" data-wow-delay=".5s">
            <p>طراحی و توسعه توسط <span style="color: #f0004c">محمد منتظری</span></p>
        </div>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset("public/js/video.js")}}"></script>
<script>

    $(document).ready(function () {
        $('.btn_comment').on('click',function (e) {
            e.preventDefault();
            let c_type = $(this).attr('data-type');
            let c_user = $(this).attr('data-content');
            let c_id = $(this).attr('data-test');
            let c_array = $(this).attr('data-array');
            let c_episode = $(this).attr('data-for');
            let token   = $('meta[name="csrf-token"]').attr('content');
            let message = $('#text').val();
            if (message.length== 0){
            swal("خطا", "لطفا بعد از نوشتن دیدگاه اقدام به ارسال آن کنید", "error");
            }else {
              $.ajax({
                  url: "{{route('addCommentFromUser')}}",
                  data: {
                      c_type: c_type,
                      c_user: c_user,
                      c_id: c_id,
                      message: message,
                      c_episode:c_episode,
                      parent: c_array,
                  },
                  headers:
                      {
                          'X-CSRF-TOKEN': token
                      },
                  success: function () {
                      setTimeout(function () {location.reload(1);}, 1000);
                      swal("باتشکر", "دیدگاه شما بعد از بررسی ثبت خواهد شد", "success");
                  }
              });
            }
        })
        $('.reply').hide();
        $('.fa-reply').on('click',function () {
            let id = $(this).attr('data-number');
            $.ajax({
                url: "{{route('replyCommentUser')}}",
                data: {
                    id: id,
                },
                success: function (data) {
                    $(".iran").attr("data-array",id);
                    $(".show-reply").text(data.data);
                    $('.reply').show();
                }
            });
            let height = $('.comment_part').height();
            $("html,body").animate({ scrollTop: height }, "slow");
           // $("html,body").slideUp();
        })
        $('.download').click(function () {
            let auth = "<?php if (\Illuminate\Support\Facades\Auth::check()){echo "Auth Ok";}  ?>";
            if (auth.length == 0){
                swal("خطا", "برای دریافت این فایل ابتدا باید وارد سایت شوید", "error");
            }
        })
        $('.tol').on('keyup',function () {
            let test = "Montazeri";
            let value = $('.tol').val();
            let res = test+value ;
            if ($.trim(res) == "Montazeri"){
                $( ".fa-times-circle" ).hide();
                $( ".fa-circle-notch" ).hide();
                $('.display-search').hide();
            }
            else{
                $( ".fa-times-circle" ).hide();
                $( ".fa-circle-notch" ).show();
                setTimeout(function () {
                    let value = $('.tol').val();
                        $('.tol,.display-search').blur(function () {
                            setTimeout(function () {
                                $('.display-search').hide();
                            },50)
                        })
                        $('.tol').focus(function () {
                            let value = $('.tol').val();
                            if (value.length != 0){
                                $('.display-search').show();
                            }
                        })
                        $.ajax({
                            url:"{{route('search_ajax')}}",
                            data:{
                                value:value
                            },
                            success:function (data) {
                                //alert(data.data);
                                if (data.data != "empty"){
                                    if(data.data.length === 0){
                                        $('.display-search').hide();
                                    }
                                    let str="<ul style='direction: rtl'>";
                                    $.each(data.data, function (key,value) {
                                        if ((typeof value.price !== 'undefined')&&(typeof value.course_id === 'undefined')){
                                            str += "<li style='border-bottom: solid 1px #e0e0e0;padding: 3px 0px;display: flex;justify-content: space-between'>" +"<a href="+"http://localhost:8888/shoplaravel/course/"+value.id+" style='font-family: yekan;font-size: .85em'>"+value.title+"</a>" +"<span style='padding: 3px 7px;background-color: #cf234f;color: #fff;border-radius: 2px;font-size: .7em; '>"+"دوره"+"</span>"+ "</li>";
                                        }
                                        if (typeof value.price === 'undefined'){
                                            str += "<li style='border-bottom: solid 1px #e0e0e0;padding: 3px 0px;display: flex;justify-content: space-between'>" +"<a href="+"http://localhost:8888/shoplaravel/article/"+value.id+" style='font-family: yekan;font-size: .85em'>"+value.title+"</a>" +"<span style='padding: 3px 7px;background-color: #cf234f;color: #fff;border-radius: 2px;font-size: .7em; '>"+"مقاله"+"</span>"+ "</li>";
                                        }
                                        if ((typeof value.price !== 'undefined')&&(typeof value.course_id !== 'undefined')){
                                            str += "<li style='border-bottom: solid 1px #e0e0e0;padding: 3px 0px;display: flex;justify-content: space-between'>" +"<a href="+"http://localhost:8888/shoplaravel/episode/"+value.id+" style='font-family: yekan;font-size: .85em'>"+value.title+"</a>" +"<span style='padding: 3px 7px;background-color: #cf234f;color: #fff;border-radius: 2px;font-size: .7em; '>"+"ویدیوها"+"</span>"+ "</li>";
                                        }
                                    });
                                    $('.display-search').show();
                                    $( ".fa-circle-notch" ).hide()
                                    $( ".fa-times-circle" ).show();
                                    $('.fa-times-circle').on('click',function () {
                                        $('.tol').val('');
                                        $(this).hide();
                                        $('.display-search').hide();
                                    })

                                    $('.display-search').html(str+'</ul>');
                                }else {
                                    $( ".fa-circle-notch" ).hide();
                                    $('.display-search').hide();
                                    $( ".fa-times-circle" ).show();
                                    $('.fa-times-circle').on('click',function () {
                                        $('.tol').val('');
                                        $(this).hide();
                                        $('.display-search').hide();

                                    })
                                }
                            },
                        })


                },1000);

            }

        })
    })
</script>
</body>
</html>