<?php

namespace Database\Seeders;

use App\Models\rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i <= 400; $i++) {
            $rating = new rating;
            $rating->user_id = rand(1, 76);
            $rating->user_rate = rand(1, 76);
            $rating->rate = rand(1, 5);
            $rating->save();
        }
    }
}
