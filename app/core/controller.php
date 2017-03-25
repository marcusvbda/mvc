<?php
namespace App\Core;

class controller 
{
	
	public function view($view,$data=[])
	{
		extract($data);
		include(ROOT_PATH.'/app/MVC/views/'.str_replace('.', '/', $view).'.php');
	}
}