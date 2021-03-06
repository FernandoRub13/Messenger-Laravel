<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Fernando',
            'email' => 'fer@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        
        User::create([
            'name' => 'Pablo',
            'email' => 'pablo@gmail.com',
            'password' => bcrypt('123456'),
        ]);
        User::create([
            'name' => 'Rocio',
            'email' => 'rocio@gmail.com',
            'password' => bcrypt('123456'),
        ]);

    }
}
