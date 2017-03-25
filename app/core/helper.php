<?php

function uppertrim($text)
{
	return trim((strtoupper($text)));
}

function asset($url = "")
{
 	return BASE_URL.'/'.$url;
}
