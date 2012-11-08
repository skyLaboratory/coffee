<?php
// Autor: Leon Bergmann
// Date : 07.11.2012 22:53 Uhr 
class loginAPI
{
	private $db;
	private $loginType;
	private $username;
	
	public function __construct($database = NULL,$loginType)
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
			$this->username = $username;
			$this->setSessions();
		}
		else
		{
			$this->callback();
		}
		
	}
	
	public function isValidAuth()
	{
		if($this->loginType === "backend")
		{
			if($_SESSION['BackendAuth'])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			if($_SESSION['FrontendAuth'])
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	private function setSessions()
	{

		if($this->loginType == "backend")
		{
			$_SESSION['BackendAuth'] = true;
		}
		else
		{
			$_SESSION['FrontendAuth'] = true;	
		}
		
		$_SESSION['username']	= $this->username;
	}
}
?>