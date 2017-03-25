<?php
use App\Core\Controller;
use App\Core\Input;
use App\Core\Router;
use App\MVC\Models\produtos;


class produtosController extends controller
{	
	public function getIndex()
	{
		$produtos = produtos::all();
		$this->view('produtos.index',compact('produtos'));
	}

	public function getCreate()
	{
		$this->view('produtos.create');
	}

	public function getShow($id)
	{
		$produto = produtos::find(base64_decode($id));
		$this->view('produtos.show',compact('produto'));
	}

	public function getEdit($id)
	{
		$produto = produtos::find(base64_decode($id));
		$this->view('produtos.edit',compact('produto'));
	}

	public function postEdit()
	{
		try
		{
			$dados = Input::get();
			$nova_imagem = Input::files()['imagem'];

			$produto = produtos::find($dados['id']);
			if(($produto['imagem']!="")&&($nova_imagem['size']>0))
			{
				if(file_exists(PUBLIC_PATH.'/uploads/produtos/'.$produto['imagem']))
					unlink(PUBLIC_PATH.'/uploads/produtos/'.$produto['imagem']);
				$upload  = $this->upload($nova_imagem);
				if($upload['success'])
				{
					$dados['imagem']=$upload['arquivo'];
				}
			}
			$produto = Produtos::update($dados['id'],$dados);
			if($dados['estoque']<=0)
				$this->emailnotificacao($dados);
			Router::go(asset('produtos/show/').base64_encode($dados['id']));
		}
		catch(Exception $e)
		{
			echo json_encode(['success'=>false,'msg'=>'Erro ao alterar :'.$e->getMessage()]);	
		}
	}

	public function postStore()
	{
		try
		{
			$dados = Input::get();
			$imagem = Input::files()['imagem'];
			if(isset($imagem))
			{
				$upload  = $this->upload($imagem);
				if($upload['success'])
				{
					$dados['imagem']=$upload['arquivo'];
				}
			}
			$produto = Produtos::create($dados);
			Router::go(asset('produtos/show/').base64_encode($produto['id']));
		}
		catch(Exception $e)
		{
			echo json_encode(['success'=>false,'msg'=>'Erro ao cadasatrar :'.$e->getMessage()]);	
		}
	}

	public function getExcluirimg($id)
	{
		$id = base64_decode($id);
		$produto = Produtos::find($id);
		if(file_exists(PUBLIC_PATH.'/uploads/produtos/'.$produto['imagem']))
			unlink(PUBLIC_PATH.'/uploads/produtos/'.$produto['imagem']);
		Produtos::update($id,['imagem'=>null]);
		Router::go(asset('produtos/edit/').base64_encode($id));
	}

	private function upload($file)
	{
		$diretorio = PUBLIC_PATH.'/uploads/produtos/';
		$arq = $diretorio . basename($file['name']);
		if (move_uploaded_file($file['tmp_name'], $arq)) 
			return["success"=>true,"arquivo"=> basename($file['name'])];
		else 
			return["success"=>false,"arquivo"=>null];
	}

	public function postDelete()
	{    
		try
		{
			Produtos::destroy(Input::get()['id']);
			Router::go(asset('produtos'));
		}
		catch(Exception $e)
		{
			echo json_encode(['success'=>false,'msg'=>'Erro ao excluir :'.$e->getMessage()]);	
		}
	}

	private function emailnotificacao($dados)
	{
		print_r($dados);exit;
	}
}