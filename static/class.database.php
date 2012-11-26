<?php
// Autor: Florian Giller
// Date : 05.11.2012
// Update: Leon Bergmann - 14.11.2012 11:54 Uhr  
class database
{
	private $connection = false;
	public $databaseName = null;
	
	public function make_connect()
	{
		mysql_connect("localhost","root","");
		if(!mysql_select_db($this->databaseName))
		{
			throw new Exception('No Database',1);
		}
		else
		{
			$this->connection = true;
		}
		
	}
	private function checkConnection()
	{
		if(!$this->connection)
		$this->make_connect();
		
	}

	public function queryAsAssoc($sql)
	{
		$this->checkConnection();
		$resource = mysql_query($sql);
		if(mysql_num_rows($resource) == 0)	
		{
			throw new Exception("no result","0x0000002");
		}
		
		while($assocRow = mysql_fetch_assoc($resource))
		{
			$assocArray[] = $assocRow;
			
		}
		return $assocArray;
	}
	
	public function queryAsSingelRowAssoc($sql)
	{
		$this->checkConnection();
		$resource = mysql_query($sql);
		$assocRow = mysql_fetch_assoc($resource);
		return $assocRow;
	}
	public function queryAsObject($sql)
	{
		$this->checkConnection();
		$resource = mysql_query($sql);
		if($resource == 0)
		{
			return false;
		}
		
		if($assocRow = mysql_fetch_object($resource))
			return $assocRow;
		else
			return false;
	}
	
	public function querySend($sql)
	{
		$this->checkConnection();
		if(mysql_query($sql)) 
			return true;
		else 
			return false;
	}
	
	public function getResourceID($sql)
	{
		$this->checkConnection();
		if($res = mysql_query($sql)) 
			return $res;
		else 
			return false;
	}
	
	public function entryExist($table,$colum,$subject)
	{
		if($this->db->querySend("SELECT * FROM ".$table." WHERE colum = $subject"))
			return true;
		else 
			return false;
	}
	

}