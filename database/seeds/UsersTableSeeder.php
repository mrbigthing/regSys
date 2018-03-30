<?php

use Illuminate\Database\Seeder;  
use App\User;

class UsersTableSeeder extends Seeder {

  public function run()
  {
    DB::table('users')->delete();

	User::create([
	    'name'    => 'admin',
	    'email'    => 'admin@admin.com',
	    'password'    => bcrypt('admin'),
	    'is_admin' => 2,//super admin,1 is admin, null or 0 is normal people
	]);
  }

}