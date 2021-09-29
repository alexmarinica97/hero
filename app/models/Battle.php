<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Battle extends Eloquent
{

    protected $fillable = [
        'arena_id',
        'number',
        'first_opponent_id',
        'second_opponent_id',
    ];


    public function firstOpponent()
    {
        return $this->hasOne(Character::class, 'id', 'first_opponent_id');
    }

    public function secondOpponent()
    {
        return $this->hasOne(Character::class, 'id', 'second_opponent_id');
    }

    public function rounds()
    {
        return $this->hasMany(Round::class, 'battle_id', 'id');
    }
}