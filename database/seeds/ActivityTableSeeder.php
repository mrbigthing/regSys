<?php

use Illuminate\Database\Seeder;  
use App\Activity;

class ActivityTableSeeder extends Seeder {

  public function run()
  {
    DB::table('activities')->delete();
  }

}