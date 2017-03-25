<?php
namespace App\Core;
use PDO;
class model 
{
	public function connect()
	{
		$conn = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_NAME, DB_USER, DB_PASS);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $conn;
	}

    public function query($query)
    {
    	$conn = model::connect();
    	return $conn->query($query)->fetchAll();
    }

    public function exec($query)
    {
    	$conn = model::connect();
    	$conn->exec($query);
        return $conn->lastInsertId();
    }

    public function insert($tabela,$dados)
    {
        $query = "insert into $tabela (";
        foreach($dados as $campo =>$valor):
            if($valor!="")
                $query.="$campo,";
        endforeach;
        $query = substr($query,0, strlen($query)-1);
        $query.=") values (";
        foreach($dados as $campo =>$valor):
            if($valor!="")                
                $query.="'".$valor."',";
        endforeach;
        $query = substr($query,0, strlen($query)-1);
        $query.=")";
        $id = Model::exec($query);
        return Model::query("select * from $tabela where id=$id")[0];
    }

    public function edit($tabela,$id,$dados)
    {
        $query = "update $tabela set ";
        foreach($dados as $campo =>$valor):
            $query.="$campo='$valor',";
        endforeach;       
        $query = substr($query,0, strlen($query)-1);
        $query.=" where id=$id";
        return Model::exec($query);
    }
}