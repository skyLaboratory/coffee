<?php
// Autor: Florian Giller
// Date : 05.11.2012

class userAdministration
{
	private $db;
	public $tableName = "user";
	
	public function __construct($database)
	{
		$this->db = $database;
		
	}
	
	// Array mit Userdaten name, passwort, e-mail
	public function addUser($formularArray)
	{
		$name 		= $formularArray['name'];
		$passwort 	= $formularArray['passwort'];
		$email 		= $formularArray['email'];
		
		if(empty($name))
			return false;
		if($this->userNameExist($name))
			return false;

		$sql = "INSERT INTO ".$this->tableName." (name, passwort, email) VALUES ('$name', '$passwort', '$email')";
		if($this->db->querySend($sql))
		{
			return true;
		}	
		
		
	}
	
	
	public function editUser($userInfos)
	{
		$id 	= $userInfos['id'];
		$name 	= $userInfos['name'];	
		$email	= $userInfos['email'];

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