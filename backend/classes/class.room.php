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
        return $this->db->queryAsAssoc("Select id,name,short From `raum` order by name ASC");
    }

    public function safeRoom($data)
    {
	    if(!isset($data['id']))
	    {
		    $query = "Insert Into raum (name,short) VALUES ('".$data['name']."','".$data['short']."')";
	    }
	    else
	    {
		    $query = "Update `raum` set `name` = '".$data['name']."', short = '".$data['short']."' where id=".$data['id'];
	    }
       
       if($this->db->querySend($query))
       {
           return "Erfolgreich gespeichert";
       }
       else
       {
           throw new Exception($query,3);
       }
       
    }

    public function deleteRoom($id)
    {
        if($this->db->querySend("Delete From `raum` where id=$id"))
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
	    	$data = $this->db->queryAsSingelRowAssoc("Select id,name,short From `raum` where id=$id");
	    	return $data;
	    }
	    catch(Exception $e)
	    {
		    throw new Exception("Fehler bei der ");
	    }
    }

}
?>
