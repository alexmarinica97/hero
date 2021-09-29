<?php


namespace App\models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

class CharacterSkill extends Eloquent
{
    use HasFactory;

    protected $table = "character_skill";
    protected $fillable = [
        'character_id',
        'skill_id',
    ];
    public $timestamps = false;
}