<?php


namespace App\managers;


use App\models\Character;
use App\traits\SystemTrait;

class CharacterManager
{
    use SystemTrait;

    /**
     * @param $luck
     * @return bool
     */
    public static function haveLuck($luck): bool
    {
        return self::chance($luck);
    }

    /**
     * @param Character $hero
     * @param Character $villain
     * @return Character
     */
    public static function getFirstAttacker(Character $hero, Character $villain): Character
    {
        if ($hero->speed != $villain->speed) {  //pick by higher speed
            $attacker = $hero->speed > $villain->speed ? $hero : $villain;
        } elseif ($hero->luck != $villain->luck) {   //pick by higher luck
            $attacker = $hero->luck > $villain->luck ? $hero : $villain;
        } else {  //pick random
            $randomPickId = rand(Character::DEFAULT_HERO_CHARACTER_ID, Character::DEFAULT_VILLAIN_CHARACTER_ID);
            $attacker = $hero->id == $randomPickId ? $hero : $villain;
        }
        return $attacker;
    }

    /**
     * @param Character $character
     * @return array
     */
    public static function constructInitialCharacterStats(Character $character): array
    {
        $skills = [];
        if ($character->skills()->exists()) {
            foreach ($character->skills()->get() as $skill) {
                $skills[] = [
                    'name' => $skill->name,
                    'code' => $skill->code,
                    'usage' => $skill->usage,
                    'chance' => $skill->chance,
                    'damage_multiplier' => $skill->damage_multiplier,
                    'defence_multiplier' => $skill->defence_multiplier,
                    'used' => false,
                ];
            }
        }
        return [
            'id' => $character->id,
            'name' => $character->name,
            'health' => $character->health,
            'strength' => $character->strength,
            'defence' => $character->defence,
            'speed' => $character->speed,
            'luck' => $character->luck,
            'skills' => $skills,
        ];
    }
}