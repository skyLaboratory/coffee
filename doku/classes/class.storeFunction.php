<?php
//Autor: Leon Bergmann 
//Date: 12.11.2012 12:15 Uhr 
class storeFunction
{
	// Var to store the DatabaseClass
	private $db;
	
	public function __construct($database = NULL)
	{
		// Register AutoLoad
		spl_autoload_register(__CLASS__.'::__autoload');
		// Define the WEBROOT
		define(__WEBROOT__,dirname(dirname(dirname(__FILE__))));
		// Check if Database is not Null
		if(is_null($database))
		{
			$this->newDatabase();
		}
		else
		{
			$this->db = $database;
		}
	}
	
	public static function __autoload($class)
	{
		// include the Class
		include(__WEBROOT__.'/static/class.'.$class.'.php');
	}
	
	private function newDatabase()
	{
		$this->db = new database;
		$this->db->databaseName = $var;
		try
		{
			$this->db->make_connect();
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			echo "<br>";
			echo $e->getCode();
			echo "<br>";
			echo $e->getFile();
			echo "<br>";
			echo $e->getLine();
			echo "<br>";
			echo $e->getTraceAsString();
			
		}

	}
	
	public function safeData($funtionName,$argsCount,$argsAsArray,$description,$classID)
	{
		
	}
}
?>