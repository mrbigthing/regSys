@extends('layout.default')
@section('content')
<div id="content" class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">用户信息</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form class="form-horizontal" role="form" method="POST" action="{{ URL('admin/user/'.$user->id) }}">
						<input name="_method" type="hidden" value="PUT">
            			<input type="hidden" name="_token" value="{{ csrf_token() }}">
            			<input type="hidden" id="family_members" name="family_members" value="">
            			<input type="hidden" id="family_numbers" name="family_numbers" value="">

						<div class="form-group">
							<label class="col-md-4 control-label">姓名：</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="name" name="name" required="required" value="{{ $user->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">身份证号：</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="identi_card" name="identi_card" value="{{ $user->identi_card }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">手机号码：</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">家庭成员：</label>
							<a href="#" id="add_members" class="add_members">+添加</a>
						</div>

						<div class="form-group" id="group_member_list">
						<?php 
							$family_json = json_decode($user->family_members);
								if (!empty($family_json)) {
									foreach($family_json as $family){
									echo "<div><label class='col-md-4 control-label'>成员(姓名+身份证)：</label>";
									echo "<div class='col-md-6 half-item'>";
									echo "<input type='text' class='form-control-half' style='width:30%' name='family_member_name' title='输入姓名' value='".$family->name."'>";
									echo "<div class='space'></div>";
									echo "<input type='text' class='form-control-half' style='width:50%;' name='family_member_identi_card' title='输入身份证号' value='".$family->identi_card."'>";
									echo "<div class='space'></div>";
									echo "<a  class='remove_members' name='remove_btn' href='#'>移除</a>";
									echo "</div>";
									echo "</div>";
								}
							}
						?>
						</div>

						<div style="text-align:center; margin-bottom:10px;">
							<button id="submit_info_btn" type="button" class="ui primary button">
									确定
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<link href="{{ URL('../css/tip-yellowsimple.css') }}" rel="stylesheet">
<link href="{{ URL('../css/profile_edit.css') }}" rel="stylesheet">
<script src="{{ URL('../js/jquery.poshytip.min.js') }}"></script>
<script src="{{ URL('../js/profileEdit.js') }}"></script>
@endsection