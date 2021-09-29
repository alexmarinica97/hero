<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Round extends Eloquent
{
    const MAX_ROUNDS = 20;

    protected $fillable = [
        'battle_id',
        'number',
        'attacker_id',
        'defender_id',
        'attacker_stats',
        'defender_stats',
        'is_luck',
    ];

    protected $casts = [
        'is_luck' => 'boolean',
        'attacker_stats' => 'array',
        'defender_stats' => 'array',
    ];

    public function attacker()
    {
        return $this->hasOne(Character::class, 'id', 'attacker_id');
    }

    public function defender()
    {
        return $this->hasOne(Character::class, 'id', 'defender_id');
    }

    public function battle()
    {
        return $this->belongsTo(Battle::class, 'id', 'battle_id');
    }
}