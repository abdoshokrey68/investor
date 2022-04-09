<?php

namespace Database\Seeders;

use App\Models\friend;
use Illuminate\Database\Seeder;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=50; $i < 100; $i++) {
            // $friend = new friend;
            friend::create([
                'user_id'       => $i,
                'friend_id'     => ++$i,
            ]);
        }
    }
}
