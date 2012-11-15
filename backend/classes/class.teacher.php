<?php
// Autor: Florian Giller
// Date : 15.11.2012

class teacher
{
	private $db;
	public $tableName = "lehrer";
	
	public function __construct($database)
	{
		$this->db = $database;
		
	}
	
	// Array mit Userdaten name, passwort, e-mail
	public function addTeacher($formularArray)
	{
		$name 		= $formularArray['name'];
		$vorname 	= $formularArray['vorname'];
		$kuerzel 	= $formularArray['kuerzel'];	
		$email 		= $formularArray['email'];
		
		
		if(empty($name))
			return false;
		if($this->teacherFullNameExist($vorname,$name))
			return false;

		$sql = "INSERT INTO ".$this->tableName." (vorname, name, kuerzel, email) VALUES ('$vorname', '$name', '$kuerzel', '$email')";
		if($this->db->querySend($sql))
		{
			return true;
		}	
		
		
	}
	
	
	public function editTeacher($formularArray)
	{
		$id 		= $formularArray['id'];
		$name 		= $formularArray['name'];
		$vorname 	= $formularArray['vorname'];
		$kuerzel 	= $formularArray['kuerzel'];	
		$email 		= $formularArray['email'];

		if(!is_numeric($id) or empty($name))
			return false;
			
		$sql = "UPDATE ".$this->tableName." SET vorname='".$vorname."', name='".$name."', email='".$email."', kuerzel='".$kuerzel."' WHERE id = $id";
		if($this->db->querySend($sql))
		{
			
			return true;
		}
		
	}

	public function getTeacherDetails($id)
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

	public function listAllTeacher()
	{
		$userList = $this->db->queryAsAssoc("SELECT id, vorname, name, kuerzel, email FROM ".$this->tableName);
		
		return $userList;	
	}
	
	private function teacherFullNameExist($vorname,$name)
	{
		if($this->db->querySend("SELECT * FROM ".$this->tableName." WHERE vorname = $vorname and name = $name"))
			return true;
		else 
			return false;
		
	}
	
	public function deleteTeacher($id)
	{
		if(!is_numeric($id)) return false; 
		
		if($this->db->querySend("DELETE FROM `".$this->tableName."` WHERE `id` = $id"))
			return true;
		else
			return false;
		
		
	}

}

?>