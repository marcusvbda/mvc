<?php
namespace App\Core;


class Route
{
	
	public static function executar($controller,$metodo,$parametros=[])
	{
		call_user_func_array([$controller,$metodo],$parametros);
	}

	public static function processUrl($url,$request_method='GET')
	{
		$controller = 'indexController';
		$metodo     = 'index';
		$parametros = [];
		$posicao    = 0;

		$url = Route::parseUrl($url);

		//identifica o controller
		if(isset($url[$posicao]))
		{
			if(file_exists(root_path().'/app/MVC/controllers/'.$url[$posicao].'Controller'.'.php'))
			{
				$controller = $url[$posicao].'Controller';
				unset($url[$posicao]);
				$posicao ++;
			}
		}

		// define o controller
		$nome_controller = $controller;	
		require root_path().'/app/MVC/controllers/'.$nome_controller.'.php';
		$controller = new $controller;
	

		// define metodo
		if(isset($url[$posicao]))
		{
			if(method_exists($controller, strtolower($request_method).ucfirst($url[$posicao])))
			{
				$metodo = $url[$posicao];
				unset($url[$posicao]); 
			}
		}
		$metodo = strtolower($request_method).ucfirst($metodo);	
		
		// retorna processado
		return ['NOME_CONTROLLER'=>$nome_controller,'CONTROLLER'=>$controller,'METODO'=>$metodo,'PARAMETROS'=> $parametros = $url ? array_values($url) : []];
	}

	public  function parseUrl($url)
	{
		// converte a url para array
		if(isset($url))
			return explode('/' , filter_var(rtrim($url, '/'),FILTER_SANITIZE_URL));
	}

	public function go($url)
	{
		header("Location:$url");
	}
	





}