<?php
namespace App\MVC\Models;
use App\Core\model;

class produtos extends Model
{
	public function find($id)
	{
		return Model::query("select * from produtos where id=$id")[0];
	}

	public function all()
	{
		return Model::query("select * from produtos");
	}

	public function destroy($id)
	{
		return Model::exec("delete from produtos where id = $id");
	}

	public function create($dados)
	{
		return Model::insert('produtos',$dados);
	}

	public function update($id,$dados)
	{
		return Model::edit('produtos',$id,$dados);
	}
}