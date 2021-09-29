<?php
namespace Database\migrations;



use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;
use App\models\Character;

class CreateCharactersTable {

    public static function up()
    {
        Capsule::schema()->create('characters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->integer('type')->default(Character::DEFAULT_CHARACTER_TYPE);
            $table->integer('minimum_health');
            $table->integer('maximum_health');
            $table->integer('minimum_strength');
            $table->integer('maximum_strength');
            $table->integer('minimum_defence');
            $table->integer('maximum_defence');
            $table->integer('minimum_speed');
            $table->integer('maximum_speed');
            $table->decimal('minimum_luck');
            $table->decimal('maximum_luck');
            $table->timestamps();
            $table->softDeletes();

        });
    }
}