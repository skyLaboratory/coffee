<?php
// Autor: Leon Bergmann 
// Date: 12.11.2012 12:15 Uhr
// Update: Leon Bergmann - 14.11.2012 13:07 Uhr 
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
		// Create a new Database instance
		$this->db = new database;
		// Set DB
		$this->db->databaseName = "doku";
		try
		{
			// Connect to the DB
			$this->db->make_connect();
		}
		catch(Exception $e)
		{
			die($e->getCode());			
		}

	}
	// Safe the needed Vales
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
	
	// Make the SQL for a Function
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
			$sql   .= "UPDATE functions SET ";
			$sql   .= "`name`				= '".$this->funcName."', ";
			$sql   .= "`kurz-beschreibung`	= '".$this->description."', ";
			$sql   .= "`date`				= ".$now.",";
			$sql   .= "`class-id`			= ".$this->classID." ";
			$sql   .= "WHERE ID				= '$this->functionID'";
		}
		$sql = str_replace("\t","", $sql);
		return $sql;
	}
	
	// main function to safe a Function 
	public function safeFunction()
	{
		$fSQL = $this->makeFunctionSQL();
		echo $fSQL."<br>";
		$this->db->querySend($fSQL);
		$dem = count($this->argsAsArray['Value']);
		for($i=0;$i<$dem;$i++)
		{
			$workI = $i + 1;
			$aSQL = $this->makeArgsSQL($this->argsAsArray['Name'][$workI],$this->argsAsArray['Value'][$workI]);
			echo $aSQL."<br>";
			$this->db->querySend($aSQL);
		}
		
		
	}
	
	public function updateFunction()
	{
		$aSQL = $this->makeFunctionSQL();
		$this->db->querySend($aSQL);
		
		return $aSQL;
	}
	
	// make the SQL for the args
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
	
	// escape strings in array
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
	
	//Args function
	public function makeArgsID($args)
	{
		entryExist("name","","");
	}
	
	public function entryExist($table,$colum,$subject)
	{
		if($this->querySend("SELECT * FROM ".$table." WHERE colum = $subject"))
			return true;
		else 
			return false;
	}
}
?>