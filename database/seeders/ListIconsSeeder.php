<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListIconsSeeder extends Seeder
{
    public function run(): void
    {
        $icons = [
            'smile',
            'horse',
            'alien',
            'hand-horns',
            'dinosaur',
            'rocket-launch',
            'dog',
            'cat',
            'ghost',
            'dragon',
            'skull',
            'burger',
            'pizza-slice',
            'shopping-cart',
            'money-bill-wave',
            'piggy-bank',
            'chart-line',
            'briefcase',
        ];


        foreach ($icons as $icon) {
            DB::table('icons')->insert([
                'name' => $icon,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
