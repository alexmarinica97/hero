<?php
use Pecee\SimpleRouter\SimpleRouter;

SimpleRouter::get('/', 'BattleController@indexAction');
SimpleRouter::get('/migrate', 'DatabaseController@migrate');
SimpleRouter::get('/seeders', 'DatabaseController@seeders');