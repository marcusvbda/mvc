<?php
namespace App\Core;
use App\Core\Compiler;

class controller 
{
	
	public function view($view,$data=[])
	{
		extract($data);
		$compiler = new Compiler();
		$view = $compiler->view($compiler->make($view));
		echo $view;
	}
}