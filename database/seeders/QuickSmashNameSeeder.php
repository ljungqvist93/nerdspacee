<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QuickSmashName;

class QuickSmashNameSeeder extends Seeder
{
    public function run(): void
    {
        $names = [

            'California Dreamin\'',
            'Here Comes the Sun',
            'Bad Moon Rising',
            'Bohemian Rhapsody',
            'Smooth Operator',
            'Living After Midnight',
            'Riders on the Storm',
            'More Than a Feeling',
            'Born to Be Wild',
            'House of the Rising Sun',
            'Don\'t Stop Believin\'',
            'Carry On Wayward Son',
            'Waiting for the Sun',
            'Against the Wind',
            'Ride Like the Wind',
            'Walking on Sunshine',
            'Stairway to Heaven',
            'Ace of Spades',
            'Billie Jean',
            'Days of Thunder',
            'Summer Night City',
            'Kickstart My Heart',
            'Sharp Dressed Man'

        ];

        foreach ($names as $name) {

            QuickSmashName::firstOrCreate([
                'name' => $name,
            ]);

        }
    }
}