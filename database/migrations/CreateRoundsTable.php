<?php

namespace Database\migrations;



use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;


class CreateRoundsTable {
    public static function up()
    {
        Capsule::schema()->create('rounds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('battle_id');
            $table->unsignedInteger('number');
            $table->unsignedInteger('attacker_id');
            $table->unsignedInteger('defender_id');
            $table->foreign('battle_id')->references('id')->on('battles')->onDelete('cascade');
            $table->foreign('attacker_id')->references('id')->on('characters')->onDelete('cascade');
            $table->foreign('defender_id')->references('id')->on('characters')->onDelete('cascade');
            $table->json('attacker_stats');
            $table->json('defender_stats');
            $table->boolean('is_luck');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}