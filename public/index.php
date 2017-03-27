<?php
// foi direcionado a pasta public via htaccess do root

//recebeu oa url em array processada pelo htacces da pasta public
require __dir__.'/../config.php';
require __dir__.'/../app/core/loader.php';
require __dir__.'/../app/MVC/models/loader.php';
use App\Core\App;
use App\Core\Router;

// carrega a aplicação e apartir do $_GET['url'] define o controller e o metodo executado
$app = new App();
$app->run();
