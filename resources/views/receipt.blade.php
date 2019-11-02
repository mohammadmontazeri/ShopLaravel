@include('layouts.webHeader')
@section('content')
    <?php
        $course = \App\Course::where('id',$pay->course_id)->get()->first();
    ?>
    <div>
        <div class="modal-dialog" role="document">
            <div  style="display: flex;flex-direction: column;justify-content: space-between;border: solid 1px #d0d0d0;border-radius: 3px;">
                <div style="background-color: #399;padding: 10px 5px !important;height: 50px;direction: rtl;border-top-left-radius: 2px;
    border-top-right-radius: 2px;">

                    <span style="color: #fff;font-size: .9em;font-weight: bold;margin-right: 35%">فاکتور خرید مربوط به : <span>{{$course->title}}</span></span>
                </div>
                <div>
                    <div style="height: 180px;padding: 40px 30px">
                        <div style="padding: 5px 10px;display: flex;direction: rtl;justify-content: space-between;border: solid 1px #d0d0d0;border-radius: 2px">
                            <span style="font-size: .9em;padding:5px 7px;font-weight: bold ">مبلغ پرداختی</span>
                            <span style="padding: 5px 7px;color: #4cae4c;border-radius: 2px;font-weight: bold">{{$course->price}}</span>
                        </div>
                        <div style="margin-top: 5px;padding: 5px 10px;display: flex;direction: rtl;justify-content: space-between;border: solid 1px #d0d0d0;border-radius: 2px">
                            <span style="font-size: .9em;padding:5px 7px;font-weight: bold ">کد پیگیری</span>
                            <span style="padding: 5px 7px;color: #399fc1;border-radius: 2px;font-weight: bold">۱۲۳۲۴۴۸۷۰۰۸۵</span>
                        </div>
                    </div>
                    <div style="height: 80px;direction: rtl;text-align: center;padding: 15px;border-top:solid 1px #e0e0e0;width: 98%;margin: auto ">
                        <span style="display: block;color: white;border: solid 1px #d0d0d0;width: 97%;padding: 15px 0px;border-radius: 3px;background-color: #cf234f;font-size: .9em">
                            خرید شما با موفقیت انجام شد
                        </span>
                    </div>
                </div>
                <div style="height: 45px;padding: 7px;text-align: center;">
                    <a href="{{url("course/$course->id")}}" style="font-size: .75em;color: #cf234f;">بازگشت به صفحه دوره مورد نظر</a>
                </div>
            </div>
        </div>
    </div>

@endsection
@include('layouts.webFooter')