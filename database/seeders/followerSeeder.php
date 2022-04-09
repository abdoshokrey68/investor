<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\follower;

class followerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i < 20; $i++) {
            $followers = new follower;
            $followers->user_id = 1;
            $followers->followers_id = $i++;
            $followers->save();
        }
    }
}
