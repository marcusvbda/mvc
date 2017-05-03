<?php

foreach (glob(__DIR__.'/../app/helpers/'.'*.php') as $filename) require_once $filename;
foreach (glob(__DIR__.'/../app/core/'.'*.php') as $filename) require_once $filename;
foreach (glob(__DIR__.'/../app/MVC/models/'.'*.php') as $filename) require_once $filename;