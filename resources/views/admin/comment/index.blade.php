@extends('layouts.admin')

@section('content')
  <div class="container">
          <div class="col-xs-12">
              <div class="box-header">
                  <h3 class="box-title">لیست همه کامنت ها</h3>
                  @if(session('msg'))
                      <label style="color: #f0004c">{{session('msg')}}</label>
                  @endif
                  <a class="label label-warning" href="{{url(route('comment.create'))}}" style="float: left;padding: 7px;">افزودن کامنت جدید</a>
              </div>
              <div class="box-body table-responsive no-padding"  style="background-color: #fff">
                      <table class="table table-hover">
                          <tr style="background-color: #4e555b; color: white">
                              <th>آی دی </th>
                              <th>متن</th>
                              <th>نویسنده</th>
                              <th>تاریخ ثبت </th>
                              <th>وضعیت</th>
                              <th>مربوط به دسته</th>
                              <th>مربوط به محتوا</th>
                              <th>ویرایش</th>
                              <th>حذف</th>
                              <th>پاسخ دادن</th>
                          </tr>
                          <?php
                          foreach ($comments as $comment){
                          ?>
                          <tr>
                              <td><?php echo $comment['id']; ?></td>
                              <td><?php echo $comment['text']; ?></td>
                              <td><?php
                                  $user = \App\User::where('id','=',$comment->user_id)->first();
                                  if ($user->role == "admin"){
                                      echo "<span style='color: #f94877'>ادمین</span>";
                                  }else{
                                      echo $user->name;
                                  }
                                  ?></td>
                              <td>
                                  <?php
                                  $v = new Verta($comment->created_at);
                                  $v = \Hekmatinasser\Verta\Verta::instance($comment->created_at);
                                  $v = \Hekmatinasser\Verta\Verta::persianNumbers($v);
                                  echo $v;
                                  ?>
                              </td>
                              <td>
                                  <?php
                                  if ($comment->status == 0)
                                  {
                                      echo "<label style='color: #f0004c'>غیرفعال</label>";
                                  }
                                  else{
                                      echo "<label style='color: #2fa360'>فعال</label>";
                                  }
                                  ?>
                              </td>
                              <td><?php
                                 if ($comment->related_to == "article"){
                                     echo "مقاله";
                                 }else{
                                     echo "دوره ویدیویی";
                                 }
                                  ?>
                              </td>
                              <td><?php
                                    if ($comment->article_id == null){
                                        $name = \App\Course::where('id',$comment->course_id)->get()->first();
                                        echo $name->title;
                                    }else{
                                        $name = \App\Article::where('id',$comment->article_id)->get()->first();
                                        echo $name->title;
                                    }
                                  ?>
                              </td>
                              <td>
                                  <?php
                                      $user = \App\User::where('id',$comment->user_id)->get()->first();
                                    if ($user->role == 'admin'){
                                    ?>
                                      <a class="label label-primary" href="{{url(route('comment.edit',['comment'=>$comment->id]))}}">ویرایش</a>
<?php
                                    }

                                  ?>
                              </td>
                              <td>
                                  <button data-test="{{$comment->id}}" data-content="comment" class="btn btn-danger delete">حذف</button>
                              </td>
                              <td>
                                  <a class="label label-info" href="{{url(route('replyComment',['id'=>$comment->id,'related'=>$comment->related_to]))}}">پاسخ بده </a></td>
                          </tr>

                          <?php } ?>

                      </table>
                  </div><!-- /.box-body -->
              </div><!-- /.box -->
              {{$comments->links()}}
          </div>

  </div>
@endsection