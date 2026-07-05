<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ListColorsSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            'red',
            'orange',
            'amber',
            'emerald',
            'blue',
            'purple',
            'black',
            'pink',
        ];

        foreach ($colors as $color) {
            DB::table('colors')->insert([
                'name' => $color,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
