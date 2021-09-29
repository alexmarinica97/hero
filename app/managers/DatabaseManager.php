<?php


namespace App\managers;


use Database\migrations\CreateArenasTable;
use Database\migrations\CreateBattlesTable;
use Database\migrations\CreateCharacterSkillTable;
use Database\migrations\CreateCharactersTable;
use Database\migrations\CreateRoundsTable;
use Database\migrations\CreateSkillsTable;
use Database\seeders\InitialArenaSeeder;
use Database\seeders\InitialCharacterSeeder;
use Database\seeders\InitialCharacterSkillsSeeder;
use Database\seeders\InitialSkillsSeeder;

class DatabaseManager
{
    /**
     * Executes the database migrations
     */
    public static function executeMigrations()
    {
        CreateArenasTable::up();
        CreateCharactersTable::up();
        CreateSkillsTable::up();
        CreateCharacterSkillTable::up();
        CreateBattlesTable::up();
        CreateRoundsTable::up();
    }

    /**
     * TODO: TO implement
     */
    public static function executeSeeders()
    {
        InitialCharacterSeeder::run();
        InitialSkillsSeeder::run();
        InitialCharacterSkillsSeeder::run();
        InitialArenaSeeder::run();
    }

}