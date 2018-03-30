@extends('layout.default')

@section('content')
<div class="ui piled segment">
  <h1 class="ui header">{{ $page->title }}</h1>

        <div class="page-content container-fluid">
            <div class="widget clear">
                <div class="widget-body widget-main">
                    <div class="form-group widget-body-m">
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="widget text-center">
                                    <div class="widget-body widget-11">
                                        <h5 class="mb-5 font-16">会刊登录信息</h5>
                                        <div class="info-img"><a href="proceeding/form.htm"><img src="../images/exhibitor_pending.png" width="240" /></a></div>
                                        <div class="font-24 fw-600 mb-20 counter"></div>
                                        <div class="btm-body">
                                            <h5 class="mb-5"></h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget text-center">
                                    <div class="widget-body widget-33">
                                        <h5 class="mb-5 font-16">录入参展人员信息</h5>
                                        <div class="info-img"><a href="worker/listing.htm"><img src="../images/worker_pending.png" width="240"></a></div>
                                        <div class="font-24 fw-600 mb-20 counter"></div>
                                        <div class="btm-body">
                                            <h5 class="mb-5"></h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget text-center">
                                    <div class="widget-body widget-22">
                                        <h5 class="mb-5 font-16">上传展示内容及展品</h5>
                                        <div class="info-img"><a href="product/listing.htm"><img src="../images/product_pending.png" width="240"></a></div>
                                        <div class="font-24 fw-600 mb-20 counter"></div>
                                        <div class="btm-body">
                                            <h5 class="mb-5"></h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget text-center">
                                    <div class="widget-body widget-55">
                                        <h5 class="mb-5 font-16">签证资料申报</h5>
                                        <div class="info-img"><a href="article/form.htm"><img src="../images/article_pending.png" width="240"></a></div>
                                        <div class="font-24 fw-600 mb-20 counter"></div>
                                        <div class="btm-body">
                                            <h5 class="mb-5"></h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget text-center">
                                    <div class="widget-body widget-66">
                                        <h5 class="mb-5 font-16">搭建管理</h5>
                                        <div class="info-img"><a href="construction/index.htm"><img src="../images/build_pending.png" width="240"></a></div>
                                        <div class="font-24 fw-600 mb-20 counter"></div>
                                        <div class="btm-body">
                                            <h5 class="mb-5"></h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="widget text-center">
                                    <div class="widget-body widget-66">
                                        <h5 class="mb-5 font-16">下载中心</h5>
                                        <div class="info-img"><a href="document/listing.htm"><img src="../images/download.png" width="240"></a></div>
                                        <div class="font-24 fw-600 mb-20 counter"></div>
                                        <div class="btm-body">
                                            <h5 class="mb-5"></h5>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div id="date" style="text-align: right;">
        <h5>报名时间 : {{ substr($page->start_register_time,0,10) }} 至 {{ substr($page->end_register_time,0,10) }}
            &nbsp; &nbsp;
            <?php
            if (substr($page->end_register_time, 0, 10) >= date('Y-m-d')) {
                $willShow = true;
            } else{
                $willShow = false;
            }
            ?>
      @if ((Auth::guest() || Auth::User()->is_admin<2) && $willShow)
          @if ($is_registered) 
            <a href="{{ URL('unregistration/activity/'.$page->id) }}">取消报名</a>
          @else
            <a href="{{ URL('registration/activity/'.$page->id) }}">我要报名</a>
            &nbsp; &nbsp;
            <a href="{{ URL('registration/activity/'.$page->id.'/edit_profile') }}">添加家属报名</a>
          @endif
      @endif
    </h5>
  </div>

  <hr>
  <div id="content" style="padding: 50px;">
    <p>
      <?php echo preg_replace('/(\.\.\/){3,4}/', '../../', $page->visacontent); ?>
    </p>
  </div>
  <div id="content" style="padding: 50px;">
    <table class="ui celled striped table">
    <?php 
      $count = 0;
      foreach ($users as $user) {
          $count += $user->number+1;
      }
      if (!Auth::guest() && Auth::User()->is_admin != null) {
        echo "<thead><tr><th colspan='4'>报名人员名单&nbsp;&nbsp;当前报名人数 : <span id='total_count' attr='".$page->id."'>".$count."</span> 人 </th></tr></thead>";
        echo "<thead><tr><th>姓名</th><th>身份证</th><th>手机</th><th>家属个数</th></tr></thead>";
        echo "<tbody>";
        foreach ($users as $user) {
          echo "<tr>";
          echo "<td>".$user->user_name."</td>";
          echo "<td>".$user->user_identi_card."</td>";
          echo "<td>".$user->user_phone."</td>";
          echo "<td>".$user->number."</td>";
          echo "</tr>";
        }
        echo "</tbody>";
      } else {
        echo "<thead><tr><th colspan='2'>报名人员名单&nbsp;&nbsp;当前报名人数 : <span id='total_count' attr='".$page->id."'>".$count."</span> 人 </th></tr></thead>";
        echo "<thead><tr><th>姓名</th><th>家属个数</th></tr></thead>";
        echo "<tbody>";
        foreach ($users as $user) {
          echo "<tr>";
          echo "<td>".$user->user_name."</td>";
          echo "<td>".$user->number."</td>";
          echo "</tr>";
        }
        echo "</tbody>";
      }
    ?>
    </table>
  </div>

  @if (!Auth::guest() && Auth::User()->is_admin != null)
    <div style="text-align:center">
      <button type="button" class="blue ui button" onClick='window.open("{{ URL('registration/activity/'.$page->id.'/export') }}")'>导出</button>
    </div>
  @endif
</div>
@endsection