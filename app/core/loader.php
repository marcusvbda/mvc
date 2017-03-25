<?php
// faz require de todos os models da pasta
foreach (glob(ROOT_PATH.'/app/core/'.'*.php') as $filename) require_once $filename;