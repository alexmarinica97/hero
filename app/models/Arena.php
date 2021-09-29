<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Arena extends Eloquent
{
    const DEFAULT_ARENA_ID = 1;
    protected $fillable = [
        'name',
        'code'
    ];
}