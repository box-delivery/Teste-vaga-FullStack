<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Domain\Users\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name" => "Douglas Salomão Leite",
            "password" => "Mudar123",
            "email" => "douglassleite@outlook.com"
        ]);
    }
}
