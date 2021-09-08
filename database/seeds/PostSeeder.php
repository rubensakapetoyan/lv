<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
//        $usersIDs = DB::table('users')->pluck('id')->toArray();
//        $websitesIDs = DB::table('websites')->pluck('id')->toArray();

        foreach (range(1,20) as $index) {
            DB::table('posts')->insert([
                'user_id' => $faker->numberBetween(2, 11), //array_rand($usersIDs),
                'content' => $faker->realText(rand(10,100)),
                'website_id' => $faker->numberBetween(1, 5),
                'title' => $faker->title,
                'created_at' => now(), //$faker->dateTime($max = 'now'),
                'updated_at' => now() //$faker->dateTime($max = 'now'),
            ]);
        }
    }

}
