@extends('layout.default')

@section('content')
<div class="container">  
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">活动列表</div>

        <div class="panel-body">

        @if (!Auth::guest() && Auth::User()->is_admin != null)
        <div style="text-align:center">
          <a href="{{ URL('activities/activity/create') }}" class="ui primary button">创建新活动</a>
          <hr>
        </div>
        @endif
          @foreach ($pages as $page)
            <div class="page ui message">
              <a href="{{ URL('activity/'.$page->id) }}" class="header">
                <h2>{{ $page->title }}</h2>
              </a>
              <h3>报名时间:{{ substr($page->start_register_time, 0, 10) }} 至 {{ substr($page->end_register_time, 0, 10) }}</h3>
              <h3>人数限制:
                @if ($page->number)
                  {{ $page->number }}
                @else
                  不限
                @endif
              </h3>
              <?php
                if (substr($page->end_register_time, 0, 10) >= date('Y-m-d')) {
                  $willShow = true;
                } else{
                  $willShow = false;
                }
              ?>

              @if ((Auth::guest() || Auth::User()->is_admin<2) && $willShow)
                  <a href="{{ URL('registration/activity/'.$page->id) }}">我要报名</a>
                  <a href="{{ URL('registration/activity/'.$page->id.'/edit_profile') }}">添加家属报名</a>
              @endif
              
            </div>
            @if (!Auth::guest() && Auth::User()->is_admin != null)
            <div style="text-align:left">
              <a href="{{ URL('activities/activity/'.$page->id.'/edit') }}" class="btn btn-success">编辑</a>

              <form action="{{ URL('activities/activity/'.$page->id) }}" method="POST" style="display: inline;">
                <input name="_method" type="hidden" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="btn btn-danger" style="margin-left:10px;">删除</button>
              </form>
            </div>
            @endif
          @endforeach
        </div>
        <div style="text-align:center">
          <?php echo $pages->render(); ?>
        </div>
      </div>
    </div>
  </div>
</div>  
@endsection