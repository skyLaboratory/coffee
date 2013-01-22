<?php
/*
* Autor: Leon Bergmann
* Datum: 21.01.2013 01:33
* Update:
* License: LICENSE.md
*/
final class settings
{
	public static $instance;
	
	public function __construct()
	{
		session_start();
	}
	
	public static function singelton()
	{
		if(!isset(self::$instance))
		{
			self::$instance = new settings;
		}
	
		return self::$instance;
	} 
	
	public function setSession($name,$value)
	{
		$name				= md5($name);
		$_SESSION[$name]	= $value;
	}
	
	public function getSession($name)
	{
		$name				= md5($name);
		return 				$_SESSION[$name];
	}
	
	public function setArrayToSession($array)
	{
		if(!is_array($array))
		{
			throw new Exception();
		}
		
		foreach($array as $key=>$element)
		{
			$key				= md5($key);
			$_SESSION[$key] 	= $element;
		}
		
		return true;
	}

	public function __invoke()
	{
		echo "<pre>";
		print_r($_SESSION);
		echo "</pre>";
	}
}
?>