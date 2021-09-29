<?php



require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([

    "driver" => getenv('DB_DRIVER'),

    "host" => getenv('DB_HOST'),

    "database" => getenv('DB_DATABASE'),

    "username" => getenv('DB_USERNAME'),

    "password" => getenv('DB_PASSWORD')

]);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();

use Pecee\SimpleRouter\SimpleRouter;

/* Load external routes file */
require_once 'routes/web.php';


SimpleRouter::setDefaultNamespace('App\controllers');

// Start the routing
SimpleRouter::start();