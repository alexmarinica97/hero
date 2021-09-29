<?php


namespace App\managers;


use App\models\Skill;
use App\traits\SystemTrait;

class SkillManager
{
    use SystemTrait;

    public static function checkIfAnyAttackerSkillUsedThisRound($attackerStats): array
    {
        if ($attackerStats['skills']) {
            foreach ($attackerStats['skills'] as &$skill) {
                if ($skill['usage'] == Skill::USAGE_ATTACK) {
                    if (self::chance($skill['chance'])) {
                        $skill['used'] = true;
                    } else {
                        $skill['used'] = false;
                    }
                }
            }
        }
        return $attackerStats;
    }

    public static function checkIfAnyDefenderSkillUsedThisRound($defenderStats): array
    {
        if ($defenderStats['skills']) {
            foreach ($defenderStats['skills'] as &$skill) {
                if ($skill['usage'] == Skill::USAGE_DEFENCE) {
                    if (self::chance($skill['chance'])) {
                        $skill['used'] = true;
                    } else {
                        $skill['used'] = false;
                    }
                }
            }
        }
        return $defenderStats;
    }

    /**
     * @param $attackerStats
     * @return int
     */
    public static function getDamageMultiplierForAttackerStats($attackerStats): int
    {
        $damageMultiplier = 1;
        if ($attackerStats['skills']) {
            foreach ($attackerStats['skills'] as $skill) {
                if ($skill['usage'] == Skill::USAGE_ATTACK) {
                    if ($skill['used']) {
                        $damageMultiplier = $skill['damage_multiplier'];
                    }
                }
            }
        }
        return $damageMultiplier;
    }

    /**
     * @param $defenderStats
     * @return int
     */
    public static function getDefenceMultiplierForDefenderStats($defenderStats): int
    {
        $defenceMultiplier = 1;
        if ($defenderStats['skills']) {
            foreach ($defenderStats['skills'] as &$skill) {
                if ($skill['usage'] == Skill::USAGE_DEFENCE) {
                    if ($skill['used']) {
                        $defenceMultiplier = $skill['defence_multiplier'];
                    }
                }
            }
        }
        return $defenceMultiplier;
    }
}