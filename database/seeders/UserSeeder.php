<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::factory()->createMany([
            ['name' => 'a', 'email' => 'a@a.com', 'password' => bcrypt('aaaaaaaa')],
            ['name' => 'usuario1', 'email' => 'usuario1@gmail.com', 'password' => bcrypt('contraseña1')],
            ['name' => 'usuario2', 'email' => 'usuario2@gmail.com', 'password' => bcrypt('contraseña2')],
        ]);
        /*User::factory()->create([
            'name' => 'a',
            'email' => 'a@a.com',
            'password' => bcrypt('aaaaaaaa'),
        ]);*/
        /*User::create([
            'name' => 'a',
            'email' => 'a@a.com',
            'password' => bcrypt('aaaaaaaa'),
        ]);*/
    }
}
