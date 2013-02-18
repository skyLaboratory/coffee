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
		
		if(strlen($passwort1) < 5)
		{
			throw new Exception("Das Passwort ist zu kurz.",3);
		}
		if($passwort1 == $name or $passwort2 == $name)
		{
			throw new Exception("Der Benutzername und das Passwort d&uuml;fen nicht &uuml;bereinstellen.",3);
		}
		// crypt the pw
		$salt		= $pwAPI->createASalt();
		
		$passwort1	= $pwAPI->crypt($passwort1,$salt); 
		$passwort2	= $pwAPI->crypt($passwort2,$salt);
		
		// check the Data
		if($passwort1 !== $passwort2)
		{
			throw new Exception("Passw&ouml;ter stimmen nicht überein.",3); 
		}
		

		if(!$this->is_email($email))
		{
			throw new Exception("Die E-Mail ist nicht valide. ",3);
		}
		
		if(empty($name))
		{
			throw new Exception("Bitte geben sie einen Namen ein.",3);
		}
		
		if($this->userNameExist($name))
		{
			throw new Exception("Dieser Name ist bereits vergeben.",3);
		}
		
		// Create SQl
		$sql = "INSERT INTO ".$this->tableName." (`name`, `passwort`, `email`, `salt`) VALUES ('$name', '$passwort1', '$email', '$salt')";
		// Instert into DB
		if($this->db->querySend($sql))
		{
			return "Benuter wurde erfolgreich angelgt";
		}	
		
		
	}
	
	
	public function editUser($userInfos)
	{
		$id 		= $userInfos['id'];
		$name 		= $userInfos['name'];	
		$email		= $userInfos['email'];
		$passwort1	= $userInfos['passwort1'];
		$passwort2	= $userInfos['passwort2'];
		$time		= time();
		
		if(empty($id) or !is_numeric($id))
		{
			throw new Exception("Bitte w&auml;hlen Sie einen Benutzer aus.",3);
		}
		
		$sql = "UPDATE ".$this->tableName." SET name='".$name."', email='".$email."' WHERE id = $id";
		
		if(!empty($passwort1) and !empty($passwort2))
		{
			
			$pwAPI		= new passwortAPI;
			
			$salt		= $pwAPI->createASalt();
			
			$passwort1	= $pwAPI->crypt($passwort1,$salt); 
			$passwort2	= $pwAPI->crypt($passwort2,$salt);
			
			if($passwort1 === $passwort2)
			{
				$sql = "UPDATE ".$this->tableName." SET name='".$name."', email='".$email."', passwort='".$passwort1."', salt='".$salt."' WHERE id = $id";
			}
			else
			{
				throw new Exception("Passw&ouml;ter stimmen nicht überein.",3);
			}
		}
		
		if($this->db->querySend($sql))
		{
			
			return "Der Benutzer wurde erfolgreich bearbeitet.";
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
		if(!is_numeric($id))
		{
			throw new Exception("Bitte w&auml;hlen Sie einen Benutzer aus.",3);	
		} 
		
		if($this->db->querySend("DELETE FROM `".$this->tableName."` WHERE `id` = $id"))
		{
			return "Benutzer erfolgreich gel&ouml;scht.";
		}
		
		
	}


	private function is_email($email) 
	{
		if(filter_var($email, FILTER_VALIDATE_EMAIL))
		{
			list($email,$domain) = explode('@',$email);
			if(!getmxrr ($domain,$mxhosts)) 
			{ 
				return FALSE; 
			}
			else 
			{ 
				return TRUE; 
			}
		}
		else
		{
			return FALSE;
		}

	} 

}

?>