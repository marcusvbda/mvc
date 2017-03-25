<?php
namespace App\Core;


class Router
{
	
	public static function executar($controller,$metodo,$parametros=[])
	{
		call_user_func_array([$controller,$metodo],$parametros);
	}

	public static function processUrl($url,$request_method='GET')
	{
		$controller = 'homeController';
		$metodo     = 'index';
		$parametros = [];
		$posicao    = 0;

		$url = Router::parseUrl($url);

		//identifica o controller
		if(isset($url[$posicao]))
		{
			if(file_exists(ROOT_PATH.'/app/MVC/controllers/'.$url[$posicao].'Controller'.'.php'))
			{
				$controller = $url[$posicao].'Controller';
				unset($url[$posicao]);
				$posicao ++;
			}
		}

		// define o controller
		$nome_controller = $controller;	
		require ROOT_PATH.'/app/MVC/controllers/'.$nome_controller.'.php';
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
		
		return ['NOME_CONTROLLER'=>$nome_controller,'CONTROLLER'=>$controller,'METODO'=>$metodo,'PARAMETROS'=> $parametros = $url ? array_values($url) : []];
	}

	public  function parseUrl($url)
	{
		if(isset($url))
			return explode('/' , filter_var(rtrim($url, '/'),FILTER_SANITIZE_URL));
	}

	public function go($url)
	{
		header("Location:$url");
	}

	





}