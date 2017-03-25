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
    	return $conn->exec($query);
    }
}