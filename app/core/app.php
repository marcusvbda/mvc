<?php
namespace App\Core;


class App 
{
	protected $request;

	public function __construct()
	{
		$this->request = Router::processUrl($this->getUrl(),$_SERVER['REQUEST_METHOD']);
	}	

	public function getUrl()
	{
		if(isset($_GET['url']))
			return $_GET['url'];
	}

	public function run()
	{
		Router::executar($this->request['CONTROLLER'],$this->request['METODO'],$this->request['PARAMETROS']);		
	}
	
}