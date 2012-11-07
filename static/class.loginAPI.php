<?php
// Autor: Leon Bergmann
// Date : 07.11.2012 22:53 Uhr 
class loginAPI
{
	private $db;
	public function __construct($database = NULL)
	{
		spl_autoload_register(__CLASS__.'::__autoload');
		define(__WEBROOT__,dirname(dirname(__FILE__)));
		
		if(is_null($database))
		{
			$this->newDatabase();
		}
		else
		{
			$this->db = $database;
		}
	}
	
	public function __autoload($class)
	{
		include(__WEBROOT__.'/static/class.'.$class.'.php');
	}
	
	private function getPWFromDatabase($Username)
	{
		$userObject	= $this->db->queryAsObject("Select passwort,salt from user where name = '$Username'");
		return $userObject;
	}
	
	private function newDatabase()
	{
		$db = new database;
		$db->databaseName = "backend";
		$this->db = $db;
		return true;
	}
	
	private function validLogin($userObjectFromDB,$passwort)
	{
		$dbPasswort		= $userObjectFromDB->passwort;
		$salt			= $userObjectFromDB->salt;
		$passwortAPI	= new passwortAPI;
		$FormPasswort	= $passwortAPI->crypt($passwort,$salt);
		if($passwortAPI->validatePasswort($dbPasswort,$FormPasswort))
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	public function makeLogin($username,$passwort)
	{
		
		$userOBJ	=	$this->getPWFromDatabase($username);
		
		if($this->validLogin($userOBJ,$passwort))
		{
			$this->setSessions();
		}
		else
		{
			$this->callback();
		}
		
	}
	
	private function callback()
	{
		echo "Callback";
	}
	
	private function setSessions()
	{
		echo "setSession";
	}
}
?>