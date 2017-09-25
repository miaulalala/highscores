<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = str_random(8);
        User::truncate();
        User::create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => bcrypt($password),
        ]);
        $this->command->info('Your password:  ' . $password );
    }
}
