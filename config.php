<?php
	define('BASE_URL','http://localhost/mvc');
	define('APP_NAME','CRUD MVC');
	define('PUBLIC_PATH',__dir__.'/public');
	define('ROOT_PATH',__dir__);

// database
	define('DB_NAME', 'DB_MVC');
	define('DB_USER', 'root');
	define('DB_PASS', '');
	define('DB_SERVER', 'localhost:3306');
// database

	define('__TOKEN',md5(APP_NAME));