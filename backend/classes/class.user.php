<?php
// Autor: Florian Giller
// Date :
// Update: Leon Bergmann - 07.11.2012 17:49 Uhr 
class user
{
	private $db;
	
	public function __construct($database)
	{
		$this->db = $database;
		
	}
	
	// Array mit Userdaten name, passwort, e-mail
	public function add($formularArray)
	{
		$name = $formularArray['name'];
		$passwort = $formularArray['passwort'];
		$email = $formularArray['email'];

		if($this->db->querySend("INSERT INTO user (name, passwort, email) VALUES ('$name', '$passwort', '$email')"))
		{
			return true;
		}	
		
		
	}
	
	
	public function edit($formularArray)
	{
		$name = $formularArray['name'];
		$passwort = $formularArray['passwort'];
		$email = $formularArray['email'];

		if($this->db->querySend("UPDATE user SET (name='$name', passwort='$passwort', email='$email')"))
		{
			return true;
		}	
		
		
	}

	public function listAll()
	{
		$userList = $this->db->queryAsAssoc("SELECT * FROM user");
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

	

}

?>