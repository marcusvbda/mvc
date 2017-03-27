<?php
// faz require todos  arquivos da pasta
foreach (glob(ROOT_PATH.'/app/MVC/models/'.'*.php') as $filename) require_once $filename;