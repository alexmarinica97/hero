<?php


namespace Database\migrations;


use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class CreateBattlesTable
{
    public static function up()
    {
        Capsule::schema()->create('battles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('number');
            $table->unsignedInteger('arena_id');
            $table->unsignedInteger('first_opponent_id');
            $table->unsignedInteger('second_opponent_id');
            $table->unsignedInteger('winner_id')->nullable(true);
            $table->foreign('arena_id')->references('id')->on('arenas')->onDelete('cascade');
            $table->foreign('first_opponent_id')->references('id')->on('characters')->onDelete('cascade');
            $table->foreign('second_opponent_id')->references('id')->on('characters')->onDelete('cascade');
            $table->foreign('winner_id')->references('id')->on('characters')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}