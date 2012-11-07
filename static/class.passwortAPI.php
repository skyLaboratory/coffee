<?php
// Autor: Leon Bergmann
// Date: 06.11.2012 13:18 Uhr 
class passwortAPI
{
	private $rounds = 5;
	private $method = 'SHA512';
	
	public function __construct()
	{
		define(__WEBROOT__,dirname(dirname(__FILE__)));
		spl_autoload_register(__CLASS__.'::__autoload');
	}
	
	public static function __autoload($class_name)
	{
		include(__WEBROOT__."/static/class.".$class_name.".php");
	}

	
	public function crypt($text,$salt)
	{
		$tmp = $text;
		for($i = 0; $i <= $this->rounds; $i++)
		{
			$tmp = $tmp.$salt;
			$tmp = hash($this->method,$tmp);
		}
		
		return $tmp;
	}
	
	public function createASalt()
	{
		$salt = randomAPI::randomChars(255);
		$salt = hash($this->method,$salt);
		
		return $salt;
	}
	
	public function validatePasswort($firtPW,$secondPW)
	{
		if($firtPW === $secondPW)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
?>