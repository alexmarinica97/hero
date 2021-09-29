<?php


namespace App\managers;


use App\models\Battle;
use App\models\Character;
use App\models\Round;

class RoundManager
{
    public static function createNewRound(Battle $battle, $roundResult, $initialRound = false)
    {
        $lastRound = Round::where('battle_id', $battle->id)->orderBy('id', 'DESC')->first();
        $roundNumber = $lastRound ? ($lastRound->number + 1) : 1;
        return Round::create([
            'battle_id' => $battle->id,
            'number' => $initialRound ? 0 : $roundNumber,
            'attacker_id' => $roundResult['attacker_stats']['id'],
            'defender_id' => $roundResult['defender_stats']['id'],
            'attacker_stats' => $roundResult['attacker_stats'],
            'defender_stats' => $roundResult['defender_stats'],
            'is_luck' => $roundResult['is_luck']
        ]);
    }
}