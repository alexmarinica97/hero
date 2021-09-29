<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Character extends Eloquent
{
    const DEFAULT_HERO_CHARACTER_ID = 1;
    const DEFAULT_VILLAIN_CHARACTER_ID = 2;

    const TYPE_HERO = 1;
    const TYPE_VILLAIN = 2;
    const DEFAULT_CHARACTER_TYPE = self::TYPE_HERO;

    protected $fillable = [
        'name',
        'code',
        'type',
        'minimum_health',
        'maximum_health',
        'minimum_strength',
        'maximum_strength',
        'minimum_defence',
        'maximum_defence',
        'minimum_speed',
        'maximum_speed',
        'minimum_luck',
        'maximum_luck',
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
        'health',
        'strength',
        'defence',
        'speed',
        'luck',
    ];

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function getHealthAttribute()
    {
        return rand($this->minimum_health, $this->maximum_health);
    }

    public function getStrengthAttribute()
    {
        return rand($this->minimum_strength, $this->maximum_strength);
    }

    public function getDefenceAttribute()
    {
        return rand($this->minimum_defence, $this->maximum_defence);
    }

    public function getSpeedAttribute()
    {
        return  rand($this->minimum_speed, $this->maximum_speed);
    }

    public function getLuckAttribute()
    {
        return rand(($this->minimum_luck * 100), ($this->maximum_luck * 100)) / 100;
    }
}