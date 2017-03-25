<?php
use App\Core\Controller;
use App\MVC\Models\produtos;
use App\Core\model;

class homeController extends controller
{	
	public function getIndex()
	{
		$produtos = produtos::all();
		$this->view('produtos.index',compact('produtos'));
	}

	public function postDestroy()
	{
		try
		{
			Produtos::destroy($_POST['id']);
			echo json_encode(['success'=>true,'msg'=>'Excluido com sucesso']);	
		}
		catch(Exception $e)
		{
			echo json_encode(['success'=>false,'msg'=>'Erro ao excluir :'.$e->getMessage()]);	
		}
	}
}