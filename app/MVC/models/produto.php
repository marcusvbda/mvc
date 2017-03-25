<?php
namespace App\MVC\Models;
use App\Core\model;

class produto extends Model
{
	public function find($id)
	{
		return Model::query("select * from produtos where id=$id")[0];
	}
}