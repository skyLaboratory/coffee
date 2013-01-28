<?php
/*
* Autor: Leon Bergmann
* Datum: 14.01.2013 01:06
* Update:
* License: LICENSE.md
*/
class room
{
    private $db;
    
    public function __construct($db)
    {
        if(!is_object($db))
        {
            throw new Exception("No db given");
        }
        else
        {
            $this->db = $db;
        }
    }
    
    public function getRoomList()
    {
        return $this->db->queryAsAssoc("Select id,name,short From rooms order by name ASC");
    }

    public function safeRoom($data)
    {
	    if(empty($data) or !is_array($data))
	    {
		    throw new Exception("Bitte f&uuml;llen Sie alle Felder aus",3);
	    }
	    
	    if(empty($data['name']))
	    {
		    throw new Exception("Bitt geben Sie einen Raumnamen ein",3);
	    }
	    
	    if(!isset($data['id']))
	    {
		    $query = "Insert Into rooms (name,short) VALUES ('".$data['name']."','".$data['short']."')";
	    }
	    else
	    {
		    $query = "Update `rooms` set `name` = '".$data['name']."', short = '".$data['short']."' where id=".$data['id'];
	    }
       
       if($this->db->querySend($query))
       {
           return "Erfolgreich gespeichert";
       }
    }

    public function deleteRoom($id)
    {
        if(empty($id))
        {
	        throw new Exception("Bitte w&auml;hlen Sie einen Raum aus",3);
        }
        
        if($this->db->querySend("Delete From `rooms` where id=$id"))
        {
            return "Der Raum wurde erfolgreich entfernt";
        }
        else
        {
            throw new Exception("Der Raum wurde nicht entfernt",3);
        }
    }

    public function getRoomData($id)
    {
	    try
	    {
	    	$data = $this->db->queryAsSingelRowAssoc("Select id,name,short From `rooms` where id=$id");
	    	return $data;
	    }
	    catch(Exception $e)
	    {
		    throw new Exception("Unknow Error",3);
	    }
    }

    public function safeNewRoomPlan($_DATA)
	{
		for($i = 0; $i < count($_DATA['to']);$i++)
		{
			$_time	= $_DATA['day'][$i];
			$_to	= $_DATA['to'][$i];
			$_from	= $_DATA['from'][$i];
			$_hour	= $_DATA['lesson'][$i]; 
		
			$this->db->querySend("Insert Into `room-plan` (`date`,`from`,`to`,`lesson`) VALUES('".$_time."','".$_to."','".$_from."','".$_hour."')");
		}
	
		return "Erfolgreich gespeichert";
	}
	
	public function getRoomPlan()
	{
		$min	= mktime(0, 0, 0, date('n'), date('j'));;
		$max	= mktime(0, 0, 0, date('n'), date('j')+7);;
		
		$result	= $this->db->queryAsAssoc("
				Select DATE( FROM_UNIXTIME( `date` ) ) as Datum, lesson as Stunde, a.name as RoomOne, b.name as RoomTo from `room-plan` as c
				inner join rooms as a ON a.id = c.from
				inner join rooms as b on b.id = c.to
				where `date` BETWEEN $min AND $max order by lesson;");

		return $result;
	}
}
?>
