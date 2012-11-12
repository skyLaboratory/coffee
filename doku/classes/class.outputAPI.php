<?php
#Leon Bergmann - 03.10.2012 14:22 Uhr 
class outputAPI
{
   
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
	
	public static function showasoption($what)
	{
		$result  = "";
		$getfromdatabase = "TEST";
		$result .= "<option value='$getfromdatabase'>$getfromdatabase</option>";
		
		return $result;
	}
} 

?>