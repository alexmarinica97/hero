<?php


namespace Database\seeders;


use App\models\Arena;

class InitialArenaSeeder
{
    public static function run()
    {
        Arena::updateOrCreate(
            [
                'code' => 'forest_of_emagia',
            ],
            [
                'name' => 'Forest of Emagia'
            ]);
    }
}