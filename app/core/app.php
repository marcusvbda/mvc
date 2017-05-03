<?php
namespace App\Core;
use App\Core\Middleware;
use App\Core\Input;

class App 
{
	protected $request;

	public function __construct()
	{
		// processa o conteudo do $_GET['url'] e retorna o resultado
		$this->request = Route::processUrl($this->getUrl(),$_SERVER['REQUEST_METHOD']);

		// limpa as variaveis $_GET, $_POST e input,
		// desta forma quando o request method pode mudar (PUT,DELETE,POST ou GET) e
		// sempre será mantida a forma de pegar as variaveis da requisição
		input::define($_SERVER['REQUEST_METHOD']);
	}	

	public function getUrl()
	{
		if(isset($_GET['url']))
			return $_GET['url'];
	}

	public function run()
	{
		// se for um request feito via formulário
		// ele precisará ter __TOKEN, isso evitará que a aplicação receba 
		// requests de fora 

		if(Middleware::verifyToken())
			Route::executar($this->request['CONTROLLER'],$this->request['METODO'],$this->request['PARAMETROS']);
		else
			echo json_encode(['success'=>false,'msg'=>'request indevido']);
	}	
}

