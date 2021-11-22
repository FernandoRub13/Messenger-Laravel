<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::create([
            'from_id' => 1,
            'to_id' => 2,
            'content' => 'Hola Pablo, ¿Cómo has estado?',
        ]);
        Message::create([
            'from_id' => 2,
            'to_id' => 1,
            'content' => 'Hola Fer, muy bien ¿Y tú?',
        ]);
        Message::create([
            'from_id' => 1,
            'to_id' => 3,
            'content' => 'Hola Rocio, ¿Cómo has estado?',
        ]);
        Message::create([
            'from_id' => 3,
            'to_id' => 1,
            'content' => 'Hola Fernandito , muy bien ¿Y tú?',
        ]);
    }
}
