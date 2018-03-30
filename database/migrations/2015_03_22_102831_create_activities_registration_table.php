<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesRegistrationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities_registration', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('activity_id');//活动id
			$table->integer('user_id');//用户id
			$table->string('user_name');//用户姓名
			$table->string('user_identi_card');//用户身份证
			$table->string('user_phone');//用户电话
			$table->string('family_members');//亲属
			$table->integer('number');//该用户报名的个数
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
		Schema::drop('activities_registrations');
	}

}
