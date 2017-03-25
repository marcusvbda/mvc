<?php
// faz require de todos os models da pasta
foreach (glob(ROOT_PATH.'/app/MVC/models/'.'*.php') as $filename) require_once $filename;