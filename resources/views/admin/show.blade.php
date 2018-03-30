@extends('layout.default')

@section('content')
<div class="container">  
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">用户列表</div>

        <div class="panel-body">
        	<div class="ui cards">
        		@foreach ($pages as $page)
			        <div class="card">
					    <div class="content">
					      <div class="header">{{ $page->name}}</div>
					      <div class="description">
					        邮箱是{{ $page->email }}<br/>
					        电话号码是{{ $page->phone }}<br/>
					        身份证号是{{ $page->identi_card }}<br/>
					        @if ($page->is_admin > 0)
					        	属于管理员
					        @else
					        	不属于管理员
					        @endif
					      </div>
					    </div>
					    <div class="ui bottom attached button">
					      <span name='view_user' attr='{{ $page->id }}'>查看</span>
					      &nbsp;&nbsp;&nbsp;&nbsp;
					      <span name='delete_user' attr='{{ $page->id }}'>删除</span>
					      &nbsp;&nbsp;&nbsp;&nbsp;
					      <span name='edit_user' attr='{{ $page->id }}'>编辑</span>
					    </div>
					  </div>
			    @endforeach
        	</div>
        </div>
        <div style="text-align:center">
          <?php echo $pages->render(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ URL('../js/admin.js') }}"></script>
@endsection