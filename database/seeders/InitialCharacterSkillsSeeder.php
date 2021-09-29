<?php


namespace Database\seeders;


use App\models\CharacterSkill;

class InitialCharacterSkillsSeeder
{
    public static function run()
    {
        CharacterSkill::updateOrCreate([
            'skill_id' => 1,
            'character_id' => 1,
        ]);
        CharacterSkill::updateOrCreate([
            'skill_id' => 2,
            'character_id' => 1,
        ]);
    }
}