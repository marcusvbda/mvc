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
		$filtro = "";
		$this->view('produtos.index',compact('produtos','filtro'));
	}

	public function postIndex()
	{
		$filtro = Input::get()['filtro'];
		$produtos = produtos::get("titulo like'%$filtro%'");
		$this->view('produtos.index',compact('produtos','filtro'));
	}

	public function getCreate()
	{
		$this->view('produtos.create');
	}

	public function getShow($id)
	{
		$produto = produtos::find(base64_decode($id));
		if(isset($_SESSION['mensagem']))
		{
			$mensagem = $_SESSION['mensagem'];			
			unset($_SESSION['mensagem']);
		}
		else
			$mensagem = "";
		$this->view('produtos.show',compact('produto','mensagem'));
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
			{
				if(!$this->emailnotificacao($dados));
				{
					$_SESSION['mensagem']="Erro ao enviar email de notificação, configure os dados do email corretamente";
				}
			}
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
		try
		{
			ini_set("SMTP",SMTP);
			ini_set("smtp_port",SMTP_PORTA);
			ini_set('sendmail_from',EMAIL);
			ini_set('auth_username ',EMAIL);
			ini_set('auth_password  ',SENHA);
			if(uppertrim($dados['email'])!="")
			{
				$destino = $dados['email'];
				$headers = 'MIME-Version: 1.0' . "\r\n";
			    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			    $headers .= 'From: $nome <$email>';		    
			    $texto = "O estoque do produto id :".$dados['id']." e titulo : ".$dados['titulo']." chegou a zero, verifique ...";
			    if(mail($destino, "Notificação de baixo estoque", $texto, $headers))
			    	return true;
			    else
			    	return false;
			}
		}
		catch(Exception $e)
		{
			return false;
		}
	}

}