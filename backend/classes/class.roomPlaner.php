<?php
/*
* Autor: Leon Bergmann
* Datum: 23.01.2013 01:41
* Update:
* License: LICENSE.md
*/
class roomPlaner
{
	private $db;
	
	public function __construct($db)
	{
		if(empty($db))
		{
			throw new Exception(10);
		}
		else
		{
			$this->db = $db;
		}
	}

	public function safeNewRoomPlan($_DATA)
	{
		
	}
}
?>
