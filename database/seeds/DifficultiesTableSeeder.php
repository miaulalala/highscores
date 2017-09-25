<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Difficulty;

class DifficultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     
    public function run()
    {
        Difficulty::create(['difficulty' => 'Easy']);
        Difficulty::create(['difficulty' => 'Medium']);
        Difficulty::create(['difficulty' => 'Hard']);
    }
}
