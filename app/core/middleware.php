<?php
namespace App\Core;

class middleware 
{
	public function verifyToken()
	{
		if(!isset($_REQUEST['INPUTS']['__TOKEN']))
		{
			if(!$_REQUEST['INPUTS'])
			{
				unset($_REQUEST['INPUTS']['__TOKEN']);
				return true;
			}
			else
				return false;
		}
		if($_REQUEST['INPUTS']['__TOKEN']==__TOKEN)
		{
			unset($_REQUEST['INPUTS']['__TOKEN']);
			return true;
		}
		else
			return false;
	}
}