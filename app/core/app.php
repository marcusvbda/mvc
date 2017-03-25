<?php
namespace App\Core;
use App\Core\Middleware;
use App\Core\Input;
class App 
{
	protected $request;

	public function __construct()
	{
		$this->request = Router::processUrl($this->getUrl(),$_SERVER['REQUEST_METHOD']);
		input::define($_SERVER['REQUEST_METHOD']);
	}	

	public function getUrl()
	{
		if(isset($_GET['url']))
			return $_GET['url'];
	}

	public function run()
	{
		if(Middleware::verifyToken())
			Router::executar($this->request['CONTROLLER'],$this->request['METODO'],$this->request['PARAMETROS']);
		else
		{
			echo json_encode(['success'=>false,'msg'=>'request indevido']);
			exit;
		}		
	}
	
}