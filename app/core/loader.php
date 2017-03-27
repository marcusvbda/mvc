<?php
// faz require todos  arquivos da pasta
foreach (glob(ROOT_PATH.'/app/core/'.'*.php') as $filename) require_once $filename;