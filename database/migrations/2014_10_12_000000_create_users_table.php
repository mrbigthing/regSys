<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');//姓名
			$table->string('email')->unique()->nullable();//邮箱
			$table->string('identi_card', 20)->nullable();//身份证
			$table->string('phone', 20)->nullable();//手机号
			$table->string('password', 60);//密码
			$table->text('family_members')->nullable();//家属,json格式
			$table->boolean('is_admin')->nullable();//是否管理员
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
