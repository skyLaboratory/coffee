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
		$anrede		= $formularArray['anrede'];
		$email 		= $formularArray['email'];
		
		
		if(empty($name))
		{
			throw new Exception("Bitte geben Sie einen Namen an.",3);
		}
		if($this->teacherFullNameExist($vorname,$name))
		{
			throw new Exception("Dieser Lehrer ist bereits vorhanden.",3);
		}
		
		if(empty($kuerzel))
		{
			$kuerzel = $this->createShort($name,$vorname);
		}

		$sql = "INSERT INTO ".$this->tableName." (vorname, name, kuerzel, email) VALUES ('$vorname', '$name', '$kuerzel', '$email')";
		if($this->db->querySend($sql))
		{
			return "Neuer Lehrer wurde angelegt";
		}	
		
		
	}
	
	
	public function editTeacher($formularArray)
	{
		$id 		= $formularArray['id'];
		$name 		= $formularArray['name'];
		$vorname 	= $formularArray['vorname'];
		$kuerzel 	= $formularArray['kuerzel'];
		$anrede		= $formularArray['anrede'];	
		$email 		= $formularArray['email'];

		if(!is_numeric($id) or empty($name))
		{
			throw new Exception("Bitte w&aulm;hlen Sie eine Leherer aus.",3);
		}
		
		if(empty($kuerzel))
		{
			$kuerzel = $this->createShort($name,$vorname);
		}
		
		$sql = "UPDATE ".$this->tableName." SET vorname='".$vorname."', name='".$name."', email='".$email."', kuerzel='".$kuerzel."', anrede ='".$anrede."' WHERE id = $id";
		if($this->db->querySend($sql))
		{
			
			return "Lehrer wurde erfolgreich beatbeitet.";
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
		$userList = $this->db->queryAsAssoc("SELECT id, vorname, name FROM ".$this->tableName." ORDER BY name");
		
		return $userList;	
	}
	public function listAllTeacherDetails()
	{
		$userList = $this->db->queryAsAssoc("SELECT id, anrede, vorname, name, kuerzel, email FROM ".$this->tableName." ORDER BY name");
		
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
		if(!is_numeric($id))
		{
			throw new Exception("Bitte w&aulm;hlen Sie eine Leherer aus.",3);
		} 
		
		if($this->db->querySend("DELETE FROM `".$this->tableName."` WHERE `id` = $id"))
		{
			return "Lehrer erfolgreich entfernt.";
		}
		
	}
	
	private function createShort($name,$vorname)
	{
		$result	= '';
		$name	= $vorname." ".$name;
		$parts	= preg_split("/ |-/", $name);
		foreach($parts as $part)
		{
			$result .= strtoupper($part{0});
		}
		return $result;
	}
	
	public function getAllFeacherForTeacher($teacherID)
	{

		return "";
	}

}

?>