<?php


namespace Database\seeders;


use App\models\Skill;

class InitialSkillsSeeder
{
    public static function run()
    {
        Skill::updateOrCreate(
            [
                'code' => 'rapid_strike',
            ],
            [
                'name' => 'Rapid Strike',
                'description' => 'Strike twice while it’s his turn to attack; there’s a 10% chance he’ll use this skill every time he attacks',
                'minimum_chance' => 0.1,
                'maximum_chance' => 0.1,
                'damage_multiplier' => 2
            ]
        );

        Skill::updateOrCreate(
            [
                'code' => 'magic_shield',
            ],
            [
                'name' => 'Magic shield',
                'description' => 'Takes only half of the usual damage when an enemy attacks; there’s a 20% change he’ll use this skill every time he defends',
                'usage' => Skill::USAGE_DEFENCE,
                'minimum_chance' => 0.2,
                'maximum_chance' => 0.2,
                'defence_multiplier' => 2
            ]
        );
    }
}