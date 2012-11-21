<?php
// Autor: Leon Bergmann
// Date : 07.11.2012 22:53 Uhr 
// Update: Leon Bergmann - 21.11.2012 19:59 Uhr  
class loginAPI
{
	private $db;
	private $loginType;
	private $username;
	
	public function __construct($loginType,$database = NULL)
	{
		spl_autoload_register(__CLASS__.'::__autoload');
		define(__WEBROOT__,dirname(dirname(__FILE__)));
		
		$this->loginType = $loginType;
		
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
		// new database instance
		$db = new database;
		// set the database 
		$db->databaseName = "backend";
		// safe the database into the local db
		$this->db = $db;
		return true;
	}
	
	private function validLogin($passwortDB,$passwort,$salt)
	{
		// new instance of passwortAPI
		$passwortAPI	= new passwortAPI;	
		// crypt the Passwort From the login
		$userpasswort	= $passwortAPI->crypt($passwort,$salt);
		// validate the Passwort
		if($dbPasswort === $FormPasswort)
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
		
		$userOBJ		= $this->getPWFromDatabase($username);
		$passwortDB		= $userOBJ->passwort;
		$salt			= $userOBJ->salt;
		
		if($this->validLogin($passwortDB,$passwort,$salt))
		{
			$this->username = $username;
			if($this->setSessions())
			{
				return true;
			}
		}
		else
		{
			return false;
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
			$_SESSION['auth'] = true;
		}
		else
		{
			$_SESSION['FrontendAuth'] = true;	
		}
		
		$_SESSION['username']	= $this->username;
		
		return true;
	}
}
?>