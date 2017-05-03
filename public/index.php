<?php
session_start();

$_ENV = parse_ini_file (__dir__.'/../.env',true);

require __dir__.'/autoload.php';

use App\Core\App;
use App\Core\Router;

$app = new App();
$app->run();



