<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i <= 20; $i++) {
            $user = new User;
            $user->name = $faker->name;
            $user->bio = $faker->text;
            $user->status = rand(0, 4);
            $user->email = $faker->safeemail;
            $user->password = $faker->password;
            $user->save();
        }
    }
}
