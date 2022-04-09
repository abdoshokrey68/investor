<?php

namespace Database\Seeders;

use Facade\Ignition\Support\FakeComposer;
use Illuminate\Database\Seeder;
use App\Models\project;

class projectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for($i = 0; $i <= 50; $i++) {
            $project = new project;
            $project->name = $faker->name;
            $project->des = $faker->text;
            $project->date = $faker->date;
            $project->tags = 'shokrey, tags,project';
            $project->status = rand(0, 3);
            $project->min_price = rand(2000, 100000);
            $project->user_id = rand(0,20);
            $project->save();
        }
    }
}
