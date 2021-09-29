<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Skill extends Eloquent
{
    const USAGE_ATTACK = 1;
    const USAGE_DEFENCE = 2;
    const DEFAULT_USAGE_TYPE = self::USAGE_ATTACK;

    protected $fillable = [
        'name',
        'code',
        'description',
        'usage',
        'minimum_chance',
        'maximum_chance',
        'damage_multiplier',
        'defence_multiplier',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $hidden = [
        'deleted_at',
        'code',
    ];

    protected $appends = [
        'chance'
    ];


    public function getChanceAttribute()
    {
        return rand(($this->minimum_chance * 100), ($this->maximum_chance * 100)) / 100;
    }
}