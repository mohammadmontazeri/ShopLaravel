@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">لیست همه پرداخت ها </h3>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">

                        <tr style="background-color: #4e555b; color: white">
                            <th>آی دی </th>
                            <th> عنوان محصول خریداری شده</th>
                            <th>خریدار</th>
                            <th>مقدار پرداخت شده</th>
                            <th>تاریخ خرید </th>
                        </tr>
                        <?php
                        foreach ($payments as $value){

                        ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php
                                    echo \App\Course::where('id',$value->course_id)->get()->first()->title;
                                ?></td>
                            <td><?php
                                echo \App\User::where('id',$value->user_id)->get()->first()->email;
                                ?></td>
                            <td style="color: #3c763d"><?php echo $value['price'];?></td>
                            <td style="color: red"><?php
                                $v = new Verta($value->created_at);
                                $v = \Hekmatinasser\Verta\Verta::instance($value->created_at);
                                $v = \Hekmatinasser\Verta\Verta::persianNumbers($v);
                                echo $v;
                                ?>
                            </td>
                        </tr>

                        <?php }

                        ?>

                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
            <?php

            ?>
        </div>
    </div>

@endsection