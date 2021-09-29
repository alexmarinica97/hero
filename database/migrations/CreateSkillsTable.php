<?php

namespace Database\migrations;



use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use App\models\Skill;


class CreateSkillsTable
{
    public static function up()
    {
        Capsule::schema()->create('skills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->text('description')->nullable(true);
            $table->unsignedInteger('usage')->default(Skill::DEFAULT_USAGE_TYPE);
            $table->unsignedInteger('damage_multiplier');
            $table->unsignedInteger('defence_multiplier');
            $table->decimal('minimum_chance');
            $table->decimal('maximum_chance');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}