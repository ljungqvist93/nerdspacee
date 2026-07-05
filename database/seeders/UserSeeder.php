<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            'Daniel',
            'Robin',
            'Gelila',
            'Rebecka',
        ];

        foreach ($users as $name) {
            User::create([
                'name' => $name,
                'username' => strtolower($name),
                'email' => strtolower($name) . '@cashsmash.test',
                'password' => Hash::make('password'),
                'image' => strtolower($name) . '.webp',
            ]);
        }
    }
}