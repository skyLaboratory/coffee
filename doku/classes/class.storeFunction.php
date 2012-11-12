<?php
//Autor: Leon Bergmann 
//Date: 12.11.2012 12:15 Uhr
class storeFunction
{
	// Var to store the DatabaseClass
	private $db;
	// LOCAL VARS 
	private $funcName;
	private $argsAsArray;
	private $description;
	private $classID;
	private $argsID;
	private $functionID;
	private $type;
	private $version;
	private $returnValue;
	private $changelogID;
	private $argsCount;
	
	public function __construct($database = NULL)
	{
		// Register AutoLoad
		spl_autoload_register(__CLASS__.'::__autoload');
		// Define the WEBROOT
		define('__WEBROOT__',dirname(dirname(dirname(__FILE__))));
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
		$this->db->databaseName = "doku";
		try
		{
			$this->db->make_connect();
		}
		catch(Exception $e)
		{
			die($e->getCode());			
		}

	}
	
	public function safeAndValidateData($funtionName,$description,$classID,$argsID,$functionID,$return,$version,$changelogID,$argsAsArray,$argsCount,$type = NULL)
	{
		$this->funcName		= mysql_real_escape_string($funtionName);
		$this->description	= mysql_real_escape_string($description);
		$this->classID		= mysql_real_escape_string($classID);
		$this->argsID		= mysql_real_escape_string($argsID);
		$this->functionID	= mysql_real_escape_string($functionID);
		$this->returnValue	= mysql_real_escape_string($return);
		$this->version		= mysql_real_escape_string($version);
		$this->changelogID	= $changelogID;
		$this->argsAsArray	= $this->checkArray($argsAsArray);
		$this->type			= $type;
	}
	
	private function makeFunctionSQL()
	{
		$sql = NULL;
		$now = time();
		if(is_null($this->type))
		{
			$sql   .= "INSERT INTO functions (`name`,`class-id`,`changelog-id`,`args-id`,`kurz-beschreibung`,`return-wert`,`date`)";
			$sql   .= "VALUES('$this->funcName','$this->classID','$this->changelogID','$this->argsID','$this->description','$this->returnValue',$now)";
			
		}
		else
		{
			$sql   .= "UPDATE function SET ";
			$sql   .= "name					= '".$this->funcName."', ";
			$sql   .= "kurz-beschreibung	= '".$this->description."', ";
			$sql   .= "version				= $this->version, ";
			$sql   .= "date					= $now ";
			$sql   .= "WHERE ID 			= $this->functionID;";
		}
		$sql = str_replace("\t","", $sql);
		return $sql;
	}
	
	public function safeFunction()
	{
		$fSQL = $this->makeFunctionSQL();
		/* $this->db->querySend($fSQL); */
		echo "<pre>";
		print_r($this->argsAsArray);
	}
	
	private function makeArgsSQL($argName,$argValue)
	{
		$sql = NULL;
		$now = time();
		if(is_null($this->type))
		{
			$sql .= "INSERT INTO args (`function-id`,`class-id`,`name`,`value`,`date`) ";
			$sql .= "VALUES ($this->functionID,NULL,'$argName','$argValue',$now)";
		}
		else
		{
			$sql .= "UPDATE args SET ";
			$sql .= "`name`		= `$argName`, ";
			$sql .= "`value`	= `$argValue`, ";
			$sql .= "`date`		= $now;";
		}
		
		$sql = str_replace("\t","", $sql);
		return $sql;
		
	}
	
	private function checkArray($array)
	{
		$value = array();
		if(is_array($array))
		{
			foreach($array as $element)
			{
				if(is_array($element))
				{
					foreach($element as $Key=>$subElement)
					{
						
						$value[$Key] = mysql_real_escape_string($subElement);
					}
				}
			}
		}
		elseif(is_string($array))
		{
			$value[] = mysql_real_escape_string($array);
		}
		
		return $array;
	}
}
?>