<?php
// Autor: Leon Bergmann 
// Date: 21.11.2012 22:06 Uhr 
class chooseTeacher
{
	private $illTeacher;
	private $illTeacherLesson;
	private $illTeacherLessonGroup = "NAT";
	private $lesson;
	private $day;
	private $db;
	
	public function __construct($id,$lesson,$day,$db)
	{
		$this->illTeacher	= $id;
		$this->lesson		= $lesson;
		$this->day			= $day;
		$this->db			= $db;
	}

	public function getAnPoxy()
	{
		$matches	= array();
		$all 		= $this->getProxys();
		foreach($all as $teacher)
		{
			$result = $this->getProxyDetails($teacher['teacher-id']);
			$matches[][$teacher['teacher-id']] = $this->getMatch($result);
			unset($result);
		}
	
		asort($matches);
		return $matches;
	}
	
	private function getMatch($_DATA)
	{
		if($this->illTeacherLessonGroup == $_DATA['afeld'])
		{
			$value = 0;
		}
		elseif($this->illTeacherLessonGroup == $_DATA['nfeld'])
		{
			$value = 50;
		}
		elseif($this->illTeacherLessonGroup == $_DATA['hfeld'])
		{
			$value = 100;
		}
		
		$value = $value - ($_DATA['h'] / 100);
		
		return $value;	
	}
	
	private function getProxys()
	{
		$sql		= "Select `teacher-id` From proxys where day = '$this->day' and lesson = '$this->lesson'";
		$result		= $this->db->queryAsAssoc($sql);
		
		return $result;
	}

	private function getProxyDetails($id)
	{
		$sql		= "SELECT `felder`.`name` as 'feld' FROM `lehrer` INNER JOIN `felder` ON `lehrer`.`haupt-feld-id` = `felder`.`id` WHERE `lehrer`.`id` = $id";
		$sql2		= "SELECT `felder`.`name` as 'feld' FROM `lehrer` INNER JOIN `felder` ON `lehrer`.`neben-feld-id` = `felder`.`id` WHERE `lehrer`.`id` = $id";
		$sql3		= "SELECT `felder`.`name` as 'feld' FROM `lehrer` INNER JOIN `felder` ON `lehrer`.`nicht-feld-id` = `felder`.`id` WHERE `lehrer`.`id` = $id";
		
		$result[]	= $this->db->queryAsObject($sql);
		$result[]	= $this->db->queryAsObject($sql2);
		$result[]	= $this->db->queryAsObject($sql3);
		
		
		$result['hfeld'] = $result[0]->feld;
		$result['nfeld'] = $result[1]->feld;
		$result['afeld'] = $result[2]->feld;
		
		unset($result[0]);
		unset($result[1]);
		unset($result[2]);
		
		return $result;
	}
}

require_once($_SERVER["DOCUMENT_ROOT"]."/coffee/static/class.database.php");
$db = new database;
$db->databaseName = "backend";
$a = new chooseTeacher(1,1,1,$db);
echo "<pre>";
print_r($a->getAnPoxy());
?>