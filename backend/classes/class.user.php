<?php
// Autor: Florian Giller
// Date : 05.11.2012
// Update: Leon Bergmann - 07.11.2012 17:49 Uhr 
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
		$name = $formularArray['name'];
		$passwort = $formularArray['passwort'];
		$email = $formularArray['email'];
		if(empty($name) or empty($passwort))
			return false;
		if($this->userExist($name))
			return false;

		if($this->db->querySend("INSERT INTO ".$this->tableName." (name, passwort, email) VALUES ('$name', '$passwort', '$email')"))
		{
			return true;
		}	
		
		
	}
	
	
	public function editUser($formularArray)
	{
		$id			= $formularArray['id'];
		$name 		= $formularArray['name'];
		$passwort 	= $formularArray['passwort'];
		$email 		= $formularArray['email'];

		if(!is_numeric($id) or empty($name))
			return false;
		
		
		if($this->db->querySend("UPDATE ".$this->tableName." SET (name='$name', passwort='$passwort', email='$email') WHERE id = $id"))
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
		$list = "<h2>Userlist</h2><ul>";
		foreach($userList as $userInfos)
		{
			$list .= "<li>".$userInfos['name'].":</li>";
			foreach($userInfos as $head=>$info)
			{
				$list .= "<li style='margin-left: 20px'>".$head.": ".$info."</li>";
				
				
			}
			$list .= "<p>____________________</p>";
		}
		$list .= "</ul>";
		
		return $list;	
	}
	
	private function userExist($name)
	{
		if($this->db->querySend("SELECT * FROM ".$this->tableName." WHERE name = $name"))
			return true;
		else 
			return false;
		
	}
	

}

?>