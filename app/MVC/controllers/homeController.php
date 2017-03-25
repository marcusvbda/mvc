<?php
use App\Core\Controller;
use App\MVC\Models\Produto;

class homeController extends controller
{
	
	public function getIndex($palavra)
	{
		$nome = 'vinicius';
		$this->view('produtos.index',compact('nome'));
	}
}