<?php
// Autor: Leon Bergmann 
// Date: 14.11.2012 11:54 Uhr 
class outputAPI
{
   	private $db;
   	private $test;
   	public function __construct($db = NULL)
   	{
	   	spl_autoload_register(__CLASS__.'::__autoload');
		define('__WEBROOT__',dirname(dirname(dirname(__FILE__))));
	   	if(is_null($db))
	   	{
		   	$this->db = $this->newDatabase();
	   	}
	   	else
	   	{
		   	$this->db = $db;
	   	}
   	}
   
   	public static function __autoload($class_name)
	{
		include(__WEBROOT__."/static/class.".$class_name.".php");
	}
    
    public function newDatabase()
	{
		$db = new database;
		$db->databaseName = "doku";
		return $db;
	}
    
    public function makeClassLayout($className,$classMethods)
    {
        if(!is_array($classMethods))
        {
            return false;
        }
        
        $className = "<div class='code'><div class='class'>".$className."<br/>{</div>";
        
        $count      = count($classMethods);
        $methods    = array();
        for($i=0;$i < $count;$i++)
        {
            $methods[] = $classMethods[$i];
        }
        
        $methods = implode("\n", $methods);
        
        $result = $className.$methods."<br/><div class='class'>}</div></div>";
        
        return $result;
    }
    
    public function makeNewFunctionLayout($functionName,$functionParameter,$functionType,$functionShortDescription,$forMethode=false)
    {
        if(is_array($functionParameter))
        {
            $parameter =  array();
            foreach($functionParameter as $param)
            {
                $parameter[] = "<label class='arg'>$".$param."</label>"; 
            }
            
        }
        elseif(is_string($functionParameter))
        {
            $parameter[] = "<label class='arg'>$".$functionParameter."</label>";
        }
        
        $functionParameter          = implode("\n", $parameter);
       
        $functionName               = "<label class='func'>".$functionName."</label>";
        $functionType               = "<label class='type'>".$functionType."</label>";
        $functionShortDescription   = "<label class='kurz'>".$functionShortDescription."</label>";
        
        if($forMethode)
        {
            $result = "<div class='functionDescription'>".$functionType.$functionName.$functionParameter."</div>"; 
        }
        else
        {
            $result = "<div class='code'><div class='functionDescription'>".$functionType.$functionName."(".$functionParameter.")".$functionShortDescription."</div></div>"; 
        }
        
        return $result;
    }
    
    public function makeChangeLogLayout($changeArray)
    {
        if(!is_array($changeArray))
        {
            return false;
        }
        
        $count      = count($changeArray);
        $result[]   = "<div class='code'><table><thead><tr><th class='action'>Aktion</th><th class='author'>Autor</th><th class='date'>Datum</th></tr></thead><tbody>";
        
        for($i=0;$i < $count; $i++)
        {
            $result[] = "<tr>"."<td>".$changeArray[$i]['action']."</td><td>".$changeArray[$i]['author']."</td><td>".$changeArray[$i]['date']."</td></tr>";
        }
        
        $result[] = "</tbody></table></div>";
        
        return $result;
    }
	
	public function showAsOption($what,$id = false)
	{
		try
		{
			$this->db->make_connect();
		}
		catch(Exeption $ex2)
		{
			die($e->getCode());
		}
		
		try
		{
			$result = "";
			$WorkArray = $this->db->queryAsAssoc("SELECT name,id FROM ".$what);
			$dem = count($WorkArray);
			
			for($i=0;$i<=$dem;$i++)
			{
				if($id == false)
				{
					@$result .= "<option value='".$WorkArray[$i]["id"]."'>".$WorkArray[$i]["name"]."</option>\n";
				}
				elseif($id == $WorkArray[$i]["id"])
				{
					@$result .= "<option value='".$WorkArray[$i]["id"]."' checked>".$WorkArray[$i]["name"]."</option>\n";
				}
				else
				{
					@$result .= "<option value='".$WorkArray[$i]["id"]."'>".$WorkArray[$i]["name"]."</option>\n";
				}
			}
			return $result;
		}
		catch(Exception $e)
		{
			if($what == "functions")
			{
				return "<option value='false'>Keine Funktionen vorhanden</option>\n";
			}
			elseif($what == "classes")
			{
				return "<option value='false'>Keine Klassen vorhanden</option>\n";
			}
			
		}
		
		
	}
	
	public function functionsInfoFromDatabase($id)
	{
		try
		{
			$this->db->make_connect();
		}
		catch(Exeption $ex2)
		{
			die($e->getCode());
		}
		
		$WorkArray = $this->db->queryAsAssoc("SELECT * FROM functions WHERE id = '$id'");
		
		$result[0] = $WorkArray[0]["name"];
		$result[1] = $WorkArray[0]["args"];
		$result[2] = $WorkArray[0]["kurz-beschreibung"];
		$result[3] = $WorkArray[0]["return-wert"];
		$result[4] = $id;
		
		return $result;
	}

	public function classesInfoFromDatabase($id)
	{
		try
		{
			$this->db->make_connect();
		}
		catch(Exeption $ex2)
		{
			die($e->getCode());
		}
		
		$WorkArray = $this->db->queryAsAssoc("SELECT * FROM classes WHERE id = '$id'");
		
		$result[0] = $WorkArray[0]["name"];
		$result[1] = $WorkArray[0]["args"];
		$result[2] = $WorkArray[0]["version"];
		$result[3] = $id;
		
		return $result;
	}
	
} 

?>