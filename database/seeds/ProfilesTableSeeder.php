<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProfilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            DB::table('tbl_profiles')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'national_id' => mt_rand(11111111,99999999),
                'created_at' => $faker->dateTime($max = 'now'),
                'updated_at' => $faker->dateTime($max= 'now')
            ]);
        }
    }
}
