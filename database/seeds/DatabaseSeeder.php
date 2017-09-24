<?php

use Illuminate\Database\Seeder;
use App\Difficulty;
use App\Highscore;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DifficultiesTableSeeder::class);
        $this->call(HighscoresTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->command->info('All tables seeded!');
    }
}
