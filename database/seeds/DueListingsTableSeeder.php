<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DueListingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 100) as $index) {
            DB::table('tbl_due_listings')->insert([
                'profile_id' => mt_rand(1,100),
                'amount' => mt_rand(100,1000000),
                'date' => $faker->date(),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max = 'now')
            ]);
        }
    }
}
