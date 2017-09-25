<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Highscore;

class HighscoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

         for ($i = 0; $i < 50; $i++) 
         {
            Highscore::create([
                'fname'     => $faker->firstName(),
                'lname'     => $faker->lastName,
                'd_id'      => $faker->numberBetween(1,3),
                'score'     => $faker->numberBetween(1,2147483647),
                'approved'  => $faker->numberBetween(0,1)
            ]);
        }
    }
}
