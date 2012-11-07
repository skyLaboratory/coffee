<?php
// Autor: Florian Giller
// Date : 05.11.2012
// Update: Leon Bergmann - 07.11.2012 17:50 Uhr 
class database
{
	private $connection = false;
	public $databaseName = null;

	
	/*
public function __construct()
	{
		$this->connection = $this->make_connect();
	}
*/
	
	private function make_connect()
	{
		mysql_connect("localhost","root","") or die(mysql_error());
		mysql_select_db($this->databaseName) or die(mysql_error());
		$this->connection = true;
		
		
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
	public function entryExist($name)
	{}
	

}