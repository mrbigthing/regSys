@extends('layout.default')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">个人信息</div>
				<div class="panel-body">
					<p><span>姓名：</span>{{ Auth::user()->name }}</p>
					<p><span>邮箱：</span>{{ Auth::user()->email }}</p>
					<p><span>身份证号：</span>{{ Auth::user()->identi_card }}</p>
					<p><span>手机号：</span>{{ Auth::user()->phone }}</p>
					<p><span>家庭成员：</span></p>
					<?php 
						$family_json = json_decode(Auth::user()->family_members);
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
				@if ( Auth::user()->is_admin < 2 )
					<div style="text-align:center; margin-bottom:10px;">
						<a href="{{ URL('profile/'.Auth::user()->id.'/edit') }}" class="negative ui button">完善资料</a>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection