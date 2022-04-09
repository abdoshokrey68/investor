<?php

namespace Database\Seeders;

use App\Models\comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i=0; $i < 30; $i++) {
            $comment = new comment;

            $comment->comment = $faker->text;
            $comment->status = '0,1,2,3,4';
            $comment->date  = date('Y-m-d');
            $comment->user_id   = rand(1 , 50);
            $comment->project_id = rand(1, 20);
            $comment->save();
        }
    }
}
