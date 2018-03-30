@extends('layout.default')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">个人信息</div>
				<div class="panel-body">
					<p><span>姓名：</span>{{ $user->name }}</p>
					<p><span>邮箱：</span>{{ $user->email }}</p>
					<p><span>身份证号：</span>{{ $user->identi_card }}</p>
					<p><span>手机号：</span>{{ $user->phone }}</p>
					<p><span>家庭成员：</span></p>
					<?php 
						$family_json = json_decode($user->family_members);
						if (!empty($family_json)) {
							echo "<table class='ui table'>";
							echo "<thead>";
							echo "<tr>";
							echo "<th>姓名</th>";
							echo "<th>身份证</th>";
							echo "</tr>";
							echo "</thead>";
							foreach($family_json as $family){
								echo "<tr>";
								echo "<td>".$family->name."</td>";
								echo "<td>".$family->identi_card."</td>";
								echo "</tr>";
							}
							echo "</table>";
						}
					?>
				</div>
				<div style="text-align:center; margin-bottom:10px;">
					<a href="{{ URL('admin/user/'.$user->id.'/reset') }}" class="negative ui button">重置密码</a>
					&nbsp;&nbsp;
					@if ($user->is_admin > 0)
						<a href="{{ URL('admin/user/'.$user->id.'/removeFromAdmin') }}" class="negative ui button">移除管理员</a>
					@else
						<a href="{{ URL('admin/user/'.$user->id.'/addAsAdmin') }}" class="negative ui button">加为管理员</a>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>
@endsection