<?php
/*
* Autor:  Leon Bergmann
* Datum:  31.12.2012 00:51 Uhr 
* Update: 01.01.2013 15:41 Uhr  
*/
class database extends PDO
{
	//safeing the instance
	private static $instance;
		
	public function __construct($table)
	{
	 	try
	 	{
			parent::__construct("mysql:host=localhost;port=3306;dbname=$table;","root","",array(PDO::ATTR_PERSISTENT => true));
		}
		catch(Exception $e)
		{
			throw new Exception($e->getMessage());
		}
	}
	
	public static function singelton($table)
	{
		if(!isset(self::$instance))
		{
			self::$instance = new database($table);
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
