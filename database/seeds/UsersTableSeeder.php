<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->truncate();

        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'username' => 'user1',
            'email' => 'user1@example.com',
            'password' => bcrypt('123456')
        ]);
    }
}


