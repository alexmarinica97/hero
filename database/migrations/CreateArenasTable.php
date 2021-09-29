<?php

namespace Database\migrations;



use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;


class CreateArenasTable {
    public static function up()
    {
        Capsule::schema()->create('arenas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}