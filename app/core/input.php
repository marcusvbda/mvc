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
				$_REQUEST['INPUTS']=$_GET;
				break;
			case 'POST':
				$_REQUEST['INPUTS']=$_POST;
				break;
			case 'PUT':
				$_REQUEST['INPUTS']=$_POST;
				break;
			case 'DELETE':
				$_REQUEST['INPUTS']=$_POST;
				break;
		}
		if(isset($_FILES))
			$_REQUEST['FILES']=$_FILES;
		unset($_GET,$_POST,$_FILES);
	}	

	public function get()
	{
		if(isset($_REQUEST['INPUTS']))
			return $_REQUEST['INPUTS'];
		else
			null;
	}

	public function files()
	{
		if(isset($_REQUEST['FILES']))
			return $_REQUEST['FILES'];
		else
			null;
	}
}