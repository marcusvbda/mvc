<?php
use App\Core\Controller;
use App\MVC\Models\produtos;
use App\Core\Input;
use App\Core\Router;

class produtosController extends controller
{	
	public function getIndex()
	{
		$produtos = produtos::all();
		$this->view('produtos.index',compact('produtos'));
	}

	public function postDelete()
	{    
		try
		{
			Produtos::destroy(Input::all()['id']);
			Router::go(asset('produtos'));
		}
		catch(Exception $e)
		{
			echo json_encode(['success'=>false,'msg'=>'Erro ao excluir :'.$e->getMessage()]);	
		}
	}
}