<?php
/*
* Autor: Leon Bergmann
* Datum: 06.02.2013 02:59
* Update:
* License: LICENSE.md
*/
class user
{
	/**
	 * _db
	 * 
	 * @var mixed
	 * @access private
	 */
	private $_db;
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $db
	 * @return void
	 */
	public function __construct($db)
	{
		$this->$_db = $db;
	}

	public function getUserDetails($UserID)
	{
		$details = $this->$_db->queryAsObject("Select * From fruser where ID = $UserID");
		return $details;
	}
	
	public function safeUserDetails($data)
	{
		$dbObj	= $this->$_db->prepare("Update `Name` = ?, `Mail` = ?, `Klasse` = ?, `Passwort` = ? where ID = ?");
		if($dbObj->execute(array($data['name'],$data['mail'],$data['klasse'],$data['passwort'],$data['ID'])))
		{
			return "Erfolgreich gespeichert";
		}
		else
		{
			throw new Exception("Es ist ein Fehler aufgetreten",3);
		}
	}
}
?>
