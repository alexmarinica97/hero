<?php


namespace App\controllers;


use App\managers\DatabaseManager;

class DatabaseController
{
    public function migrate()
    {
        DatabaseManager::executeMigrations();
        return 'success'; //TODO: return if migrations are up to date
    }

    public function seeders()
    {
        DatabaseManager::executeSeeders();
        return 'success'; //TODO: return if seeders are up to date
    }
}