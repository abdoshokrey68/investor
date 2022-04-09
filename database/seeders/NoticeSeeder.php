<?php

namespace Database\Seeders;

use App\Models\notice;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 100; $i++) {
            $notice = new notice;
            $notice->des = $faker->text;
            $notice->date = $faker->date;
            $notice->show = 0;
            $notice->user_id = rand(1, 20);
            $notice->manage_id = rand(2, 50);
            $notice->project_id = rand(1 , 50);
            $notice->save();
        }
    }
}
