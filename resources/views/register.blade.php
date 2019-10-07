@include('layouts.webHeader')
@section('content')
    <div class="breadcrumbs" style="direction: rtl">
        @if(session('msg'))
            <span style="color: #f0004c;text-align: center;direction: rtl;display: block" >**{{session('msg')}}**</span>
        @endif
            @if ($errors->any())

                        @foreach ($errors->all() as $error)
                            <li style="color: #f0004c;text-align: center;direction: rtl;display: block">کاربری با این ایمیل قبلا ثبت نام کرده است</li>
                        @endforeach

            @endif
    </div>
    <div class="register">
        <div class="container" style="direction: rtl">
            <h3 class="animated wow zoomIn" data-wow-delay=".5s" style="font-family: yekan">فرم ثبت نام</h3>
            <div class="login-form-grids">
                <form class="animated wow slideInUp" data-wow-delay=".5s" method="POST" action="{{url('/admin/register')}}">
                    @csrf
                    {{method_field('post')}}
                    <input type="text" placeholder="نام کاربری را وارد کنید" required=""  name="name">
                    <br>
                    <input type="email" placeholder="آدرس ایمیل را وارد کنید" required="" name="email">
                    <input type="password" placeholder="رمز عبور را وارد کنید" required="" name="password">
                    <input type="submit" value="ثبت نام" style="border-radius: 2px;">
                </form>
            </div>
            <div class="register-home animated wow slideInUp" data-wow-delay=".5s" style="border-radius: 2px;">
                <a href="{{url(route('home'))}}" style="border-radius: 2px;">صفحه اصلی</a>
            </div>
        </div>
    </div>
@endsection
@include('layouts.webFooter')