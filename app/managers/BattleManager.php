<?php


namespace App\managers;


use App\models\Arena;
use App\models\Battle;

class BattleManager
{
    /**
     * @param $firstOpponentStats
     * @param $secondOpponentStats
     * @return Battle
     */
    public static function createNewBattle($firstOpponentStats, $secondOpponentStats): Battle
    {
        $lastBattle = Battle::latest('created_at')->first();
        $battleNumber = $lastBattle ? ($lastBattle->number + 1) : 1;
        return Battle::create([
            'number' => $battleNumber,
            'first_opponent_id' => $firstOpponentStats['id'],
            'second_opponent_id' => $secondOpponentStats['id'],
            'arena_id' => Arena::DEFAULT_ARENA_ID //TODO: to implement multiple arena logic
        ]);
    }

    /**
     * @param $attackerStats
     * @param $defenderStats
     * @return integer|float
     */
    public static function calculateDamage($attackerStats, $defenderStats): float|int
    {
        $damageMultiplier = SkillManager::getDamageMultiplierForAttackerStats($attackerStats);
        $defenceMultiplier = SkillManager::getDefenceMultiplierForDefenderStats($defenderStats);
        $damage = ($attackerStats['strength'] * $damageMultiplier) - $defenderStats['defence'];
        if ($defenceMultiplier > 1) {
            $damage = $damage / $defenceMultiplier;
        }
        return $damage >= 0 ? $damage : 0;
    }

    /**
     * @param $defenderHealth
     * @param $damage
     * @return integer|float
     */
    public static function calculateHealth($defenderHealth, $damage): float|int
    {
        return $defenderHealth - $damage;
    }

    /**
     * @param $defenderHealth
     * @return bool
     */
    public static function checkIfBattleIsOver($defenderHealth): bool
    {
        return $defenderHealth <= 0;
    }
}