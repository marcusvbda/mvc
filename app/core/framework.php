<?php
function env($value,$default=null)
{
	if(isset($_ENV[$value]))
		return $_ENV[$value];
	else
		return $default;
}

function asset($url = "")
{
 	return env('BASE_URL').'/'.$url;
}

function public_path()
{
	return __dir__.'/../../public';
}

function root_path()
{
	return __dir__.'/../../';
}