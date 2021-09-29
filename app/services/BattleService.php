<?php


namespace App\services;


use App\managers\BattleManager;
use App\managers\CharacterManager;
use App\managers\RoundManager;
use App\managers\SkillManager;
use App\models\Battle;
use App\models\Character;
use App\models\Round;
use App\traits\SystemTrait;

class BattleService
{
    use SystemTrait;

    /**
     * @return array
     */
    public static function initiateNewBattle(): array
    {
        $hero = Character::findOrFail(Character::DEFAULT_HERO_CHARACTER_ID);
        $villain = Character::findOrFail(Character::DEFAULT_VILLAIN_CHARACTER_ID);
        $attacker = CharacterManager::getFirstAttacker($hero, $villain);
        $defender = $attacker->id == $hero->id ? $villain : $hero;
        return [
            'attacker_stats' => CharacterManager::constructInitialCharacterStats($attacker),
            'defender_stats' => CharacterManager::constructInitialCharacterStats($defender)
        ];
    }

    /**
     * @param $opponents
     * @return Battle
     */
    public static function startBattle($opponents): Battle
    {
        $attackerStats = $opponents['attacker_stats'];
        $defenderStats = $opponents['defender_stats'];
        $battle = BattleManager::createNewBattle($attackerStats, $defenderStats);
        return self::fight($battle, $opponents);
    }

    /**
     * @param Battle $battle
     * @param $opponentsStats
     * @return Battle
     */
    private static function fight(Battle $battle, $opponentsStats): Battle
    {
        $roundNumber = 1;
        $attackerStats = $opponentsStats['attacker_stats'];
        $defenderStats = $opponentsStats['defender_stats'];
        $winnerId = null;

        RoundManager::createNewRound($battle, [
            'attacker_stats' => $attackerStats,
            'defender_stats' => $defenderStats,
            'is_luck' => false
        ], true);


        do {
            $isLuck = self::chance($defenderStats['luck']);
            if (!$isLuck) {
                $attackerStats = SkillManager::checkIfAnyAttackerSkillUsedThisRound($attackerStats);
                $defenderStats = SkillManager::checkIfAnyDefenderSkillUsedThisRound($defenderStats);
                $damage = BattleManager::calculateDamage($attackerStats, $defenderStats);
                $attackerStats['damage'] = $damage;
                $defenderStats['health'] = BattleManager::calculateHealth($defenderStats['health'], $damage);
            }
            if (BattleManager::checkIfBattleIsOver($defenderStats['health'])) {
                $winnerId = $attackerStats['id'];
            }

            RoundManager::createNewRound($battle, [
                'attacker_stats' => $attackerStats,
                'defender_stats' => $defenderStats,
                'is_luck' => $isLuck
            ]);

            $tmpAttackerStats = $attackerStats;
            $attackerStats = $defenderStats;
            $defenderStats = $tmpAttackerStats;
            $roundNumber++;
        } while($roundNumber <= Round::MAX_ROUNDS && $winnerId == null);

        if ($winnerId) {
            $battle->winner_id = $winnerId;
            $battle->save();
        }

        return $battle;
    }
}