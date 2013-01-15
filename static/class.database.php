<?php
/*
* Autor:  Leon Bergmann
* Datum:  31.12.2012 00:51 Uhr 
* Update: Leon Bergmann - 07.01.2013 14:33 Uhr   
*/
class database extends PDO
{
	//safeing the instance
	private static $instance;
	private static $database;
	
	public function __construct($db)
	{
	 	try
	 	{
			parent::__construct("mysql:host=sky-lab.de;port=3306;dbname=$db;","coffee","WWMt85SECQ8Tr5jN",array(PDO::ATTR_PERSISTENT => true));
			self::$database = $db;
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	public static function singelton($db)
	{
		if(!isset(self::$instance) and self::$database != $db)
		{
			self::$instance = new database($db);
		}
		return self::$instance;
	}
	
	public function queryAsObject($query)
	{
		try{
			$result = $this->query($query);
			$result = $result->fetchObject();
			return $result;
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	public function queryAsSingelRowAssoc($query)
	{
		try
		{
			$result = $this->query($query);
			$result = $result->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		catch(Exception $e)
		{
			throw new Exception($e-getMessage());
		}
	}
	

	
	public function queryAsAssoc($query)
	{
		try{
			$result = $this->query($query);
			$result = $result->fetchAll(PDO::FETCH_ASSOC);
			return $result;
		}
		catch(Exception $e)
		{
			throw new Exception($e-getMessage());
		}
	}
	
	public function querySend($query)
	{
		try{
			$result = $this->query($query);
			if($result)
				return true;
			else
				return false;
		}
		catch(Exception $e)
		{
			throw new Exception($e-getMessage());
		}
	}
	
	public function getResourceID($query)
	{
		try{
			$result = $this->query($query);
			return $result;
		}
		catch(Exception $e)
		{
			throw new Exception($e-getMessage());
		}
	}
}
?>
