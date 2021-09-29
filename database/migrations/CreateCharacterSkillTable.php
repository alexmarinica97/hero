<?php

namespace Database\migrations;



use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;


class CreateCharacterSkillTable {
    public static function up()
    {
        Capsule::schema()->create('character_skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('skill_id');
            $table->unsignedInteger('character_id');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
            $table->foreign('character_id')->references('id')->on('characters')->onDelete('cascade');
        });
    }
}