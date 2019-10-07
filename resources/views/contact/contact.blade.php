@include('layouts.webHeader')
@section('content')
    <div class="breadcrumbs" style="direction: rtl">
        @if(session('msg'))
            <span style="color: #f0004c;text-align: center;direction: rtl;display: block" >**{{session('msg')}}**</span>
        @endif
    </div>
    <!-- //breadcrumbs -->
    <!-- login -->
    <div class="mail animated wow zoomIn" data-wow-delay=".5s">
        <div class="container">
            <h3 style="font-family: yekan">تماس با ما</h3>
            <p class="est">از راه های ارتباطی زیر می توانید با ما در ارتباط باشید</p>
            <div class="mail-grids" style="direction: rtl">
                <div class="col-md-12 mail-grid-left animated wow slideInLeft" data-wow-delay=".5s">
                    <form action="{{route('contactStore')}}" method="post">
                        @csrf
                        <input type="text" placeholder="نام" required="" name="name">
                        <input type="email" placeholder="ایمیل" required="" name="email">
                        <textarea type="text" name="message"  required="" placeholder="پیام مورد نظرتان را بنویسید ..."></textarea>
                        <input type="submit" value="ثبت" style="border-radius: 2px;" >
                    </form>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@endsection
@include('layouts.webFooter')