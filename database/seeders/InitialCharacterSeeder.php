<?php


namespace Database\seeders;


use App\models\Character;

class InitialCharacterSeeder
{
    public static function run()
    {
        Character::updateOrCreate(
            [
                'code' => 'orderus',
            ],
            [
                'name' => 'Orderus',
                'minimum_health' => 70,
                'maximum_health' => 100,
                'minimum_strength' => 70,
                'maximum_strength' => 80,
                'minimum_defence' => 45,
                'maximum_defence' => 55,
                'minimum_speed' => 40,
                'maximum_speed' => 50,
                'minimum_luck' => 0.10,
                'maximum_luck' => 0.30,
            ]
        );

        Character::updateOrCreate(
            [
                'code' => 'wild_beast_from_forest_of_emagia',
            ],
            [
                'name' => 'Wild Beast',
                'type' => Character::TYPE_VILLAIN,
                'minimum_health' => 60,
                'maximum_health' => 90,
                'minimum_strength' => 40,
                'maximum_strength' => 60,
                'minimum_defence' => 40,
                'maximum_defence' => 60,
                'minimum_speed' => 40,
                'maximum_speed' => 60,
                'minimum_luck' => 0.25,
                'maximum_luck' => 0.40,
            ]
        );
    }
}