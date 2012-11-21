<?php
// Autor: Florian Giller
// Date : 05.11.2012
// Update: Leon Bergmann - 21.11.2012 14:28 Uhr 
class userAdministration
{
	private $db;
	public $tableName = "user";
	
	public function __construct($database)
	{
		$this->db = $database;
		spl_autoload_register(__CLASS__.'::__autoload');
		define(__WEBROOT__,dirname(dirname(dirname(__FILE__))));
	}
	
	public function __autoload($class)
	{
		include(__WEBROOT__.'/static/class.'.$class.'.php');
	}
	
	// Array mit Userdaten name, passwort, e-mail
	public function addUser($formularArray)
	{
		// create a PasswortAPI Instance 
		$pwAPI		= new passwortAPI;
		// local safe of the values from the From
		$name 		= $formularArray['name'];
		$passwort1 	= $formularArray['passwort1'];
		$passwort2	= $formularArray['passwort2'];
		$email 		= $formularArray['email'];
		// crypt the pw
		$salt		= $pwAPI->createASalt();
		
		$passwort1	= $pwAPI->crypt($passwort1,$salt); 
		$passwort2	= $pwAPI->crypt($passwort2,$salt);
		
		if($passwort1 !== $passwort2)
		{
			throw new Exception("Passw&ouml;ter stimmen nicht überein",3); 
		}
		
		//check the values
		if(empty($name))
		{
			throw new Exception("Bitte geben sie einen Namen ein",3);
		}
		if($this->userNameExist($name))
		{
			throw new Exception("Dieser Name ist bereits vergeben",3);
		}
		// Create SQl
		$sql = "INSERT INTO ".$this->tableName." (`name`, `passwort`, `email`, `salt`) VALUES ('$name', '$passwort', '$email', '$salt')";
		// Instert into DB
		if($this->db->querySend($sql))
		{
			return true;
		}	
		
		
	}
	
	
	public function editUser($userInfos)
	{
		$id 		= $userInfos['id'];
		$name 		= $userInfos['name'];	
		$email		= $userInfos['email'];
		$passwort	= $userInfos['passwort'];

		if(!is_numeric($id) or empty($name))
			return false;
			
		$sql = "UPDATE ".$this->tableName." SET name='".$name."', email='".$email."' WHERE id = $id";
		if($this->db->querySend($sql))
		{
			
			return true;
		}
		
	}

	public function getUserDetails($id)
	{
		if(is_numeric($id))
		{
			if($userDetails = $this->db->queryAsSingelRowAssoc("SELECT * FROM ".$this->tableName." WHERE id = $id"))
			{
				return $userDetails;
				
				
			}
			else return false;
			
			
		}
		else return false;

		
	}

	public function listAllUsers()
	{
		$userList = $this->db->queryAsAssoc("SELECT id, name, email FROM ".$this->tableName);
		
		return $userList;	
	}
	
	private function userNameExist($name)
	{
		if($this->db->querySend("SELECT * FROM ".$this->tableName." WHERE name = $name"))
			return true;
		else 
			return false;
		
	}
	public function deleteUser($id)
	{
		if(!is_numeric($id)) return false; 
		
		if($this->db->querySend("DELETE FROM `".$this->tableName."` WHERE `id` = $id"))
			return true;
		else
			return false;
		
		
	}


}

?>