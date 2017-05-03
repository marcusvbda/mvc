<?php
use App\Core\Controller;
class indexController extends controller
{	
	public function getIndex()
	{
		return $this->view('home.index');
	}

	public function getInfo()
	{
		phpinfo();
	}
}