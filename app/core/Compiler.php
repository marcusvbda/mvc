<?php
namespace App\Core;

class Compiler 
{	
	public function get($view)
	{
		return file_get_contents(root_path().'/app/MVC/views/'.str_replace('.', '/', $view).'.php');
	}

	public function make($view)
	{
		if(file_exists(root_path()."/cache/views/$view.php"))
			unlink(root_path()."/cache/views/$view.php");
		$content = $this->get($view);		
		$url = root_path()."/cache/views/$view.php";
		$file = fopen($url, 'a');
		fwrite($file, $this->compile($content));
		fclose($file);
		return $url;
	}

	public function view($url)
	{
		include $url;
	}

	public function compile($content)
	{
		return $content;
	}
}