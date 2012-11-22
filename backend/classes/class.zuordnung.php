<?php
// Autor: Florian Giller
// Date : 15.11.2012

class teacher_subject
{
	private $db;
	public $tableName = "lehrer-faecher";
	
	
	public function __construct($database)
	{
		$this->db = $database;
	}
	
	private function checkFormVars(&$array,$firstKey)
	{
		
		if(!$array[$firstKey][0]) 
			throw new Exception("Es wurden nicht alle Felder ausgef&uuml;llt.",3);
		
		//$array = array_unique($array);
		foreach($array[$firstKey] as $key=>$row)
		{
			if(!$row) unset($array[$firstKey][$key]);
			
		}
		
	}
	
	public function saveCombination($form)
	{
		$this->checkFormVars($form,'teacher');
		$this->checkFormVars($form,'subject');
		
		if(!is_numeric($form['switch']))
			return false;
			
			
		switch($form['switch'])
		{
			//Lehrer->Fächer
			case "1":
				$l_id = $form['teacher'][0];
				$sql = "";
				foreach($form['subject'] as $f_id)
				{
					$sqlData[] = "($l_id,$f_id)";
					
				}
				break;
				
			//Fächer->Lehrer
			case "2":
				$f_id = $form['subject'][0];
				$sql = "";
				foreach($form['teacher'] as $l_id)
				{
					$sqlData[] = "($l_id,$f_id)";
					
				}
				break;
				
			default:
				throw new Exception("Fehler beim Zuordnen.",3);
				break;
	
		}
		
		$beginnSQL = "Insert INTO `".$this->tableName."` (`lehrer-id`,`fach-id`) VALUES ";

		$sql = $beginnSQL.implode(", ", $sqlData);
		/*
if($this->fieldExist('name', $name) or $this->fieldExist('kuezel', $kuerzel))
			return false;
*/
		if(!$this->db->querySend($sql))
		{
			throw new Exception("Datenbankfehler.",3);
		}	
		else
			return "Zuordnung wurde gespeichert.";

		
	}
	
	

	public function getSubjectDetails($id)
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

	public function listAllSubject()
	{
		$userList = $this->db->queryAsAssoc("SELECT id, name, kuerzel, beschreibung FROM ".$this->tableName);
		
		return $userList;	
	}
	
	private function fieldExist($field,$content)
	{
		if($this->db->querySend("SELECT * FROM ".$this->tableName." WHERE $field = $content"))
			return true;
		else 
			return false;
		
	}
	
	public function deleteSubject($id)
	{
		if(!is_numeric($id)) return false; 
		
		if($this->db->querySend("DELETE FROM `".$this->tableName."` WHERE `id` = $id"))
			return true;
		else
			return false;
		
		
	}

}

?>