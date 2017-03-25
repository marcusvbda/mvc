<?php
use App\Core\Controller;
class homeController extends controller
{	
	public function getIndex()
	{
		$this->view('home.index');
	}
}