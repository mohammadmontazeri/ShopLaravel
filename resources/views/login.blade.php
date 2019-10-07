@include('layouts.webHeader')
@section('content')
<div class="breadcrumbs" style="direction: rtl">
    @if(session('msg'))
        <span style="color: #f0004c;text-align: center;direction: rtl;display: block" >**{{session('msg')}}**</span>
        @endif
</div>
<!-- //breadcrumbs -->
<!-- login -->
<div class="login">
    <div class="container" style="direction: rtl">
        <h3 style="font-family: yekan" class="animated wow zoomIn" data-wow-delay=".5s">فرم ورود</h3>
        <div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
            <form action="{{route('LoginPostUser')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="email" name="email" placeholder="ایمیل خود را وارد کنید" required=" " >
                <input type="password" name="password" placeholder="رمز عبور خود را وارد کنید" required=" " >
                <div class="forgot">
                    <a href="#">رمز عبور خود را فراموش کردید ؟</a>
                </div>
                <input type="submit" value="ورود" style="border-radius: 2px;">
            </form>
        </div>
       </div>
</div>
@endsection
@include('layouts.webFooter')