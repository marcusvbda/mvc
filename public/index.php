<?php
require __dir__.'/../config.php';
require __dir__.'/../app/core/loader.php';
require __dir__.'/../app/MVC/models/loader.php';
use App\Core\App;
use App\Core\Router;
$app = new App();
$app->run();
