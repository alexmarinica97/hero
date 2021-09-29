<?php


namespace App\controllers;


use App\managers\BattleManager;
use App\models\Battle;
use App\provider\View;
use App\services\BattleService;

class BattleController
{
    public function indexAction()
    {
        $opponents = BattleService::initiateNewBattle();
        $battle = BattleService::startBattle($opponents);
        $view = new View('battle');
        $view->assign(['battle' => $battle]);
    }
}