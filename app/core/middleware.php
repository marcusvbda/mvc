<?php
namespace App\Core;

class middleware 
{
	public function verifyToken()
	{
		if(!isset($_REQUEST['__TOKEN']))
		{
			if(!$_REQUEST)
			{
				unset($_REQUEST['__TOKEN']);
				return true;
			}
			else
				return false;
		}

		if($_REQUEST['__TOKEN']==__TOKEN)
		{
			unset($_REQUEST['__TOKEN']);
			return true;
		}
		else
			return false;
	}
}