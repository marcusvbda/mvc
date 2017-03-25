<?php
namespace App\Core;

class input 
{	
	public function define()
	{
		unset($_GET['url']);
		switch (uppertrim($_SERVER['REQUEST_METHOD'])) 
		{
			case 'GET':
				$_REQUEST=$_GET;
				break;
			case 'POST':
				$_REQUEST=$_POST;
				break;
			case 'PUT':
				$_REQUEST=$_POST;
				break;
			case 'DELETE':
				$_REQUEST=$_POST;
				break;
		}
		unset($_GET,$_POST);
	}	

	public function all()
	{
		return $_REQUEST;
	}
}