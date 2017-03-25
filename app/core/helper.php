<?php

function uppertrim($text)
{
	return trim((strtoupper($text)));
}

function asset($folder = "")
{
	$url = $_SERVER['REQUEST_URI']; 
	$parts = explode('/',$url);
	$dir = $_SERVER['SERVER_NAME'];
	for ($i = 0; $i < count($parts) - 1; $i++):
	  $dir .= $parts[$i] . "/";
	endfor;
 	return 'http://'.$dir.$folder;
}
