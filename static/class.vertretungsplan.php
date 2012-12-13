<?php
/*
* Autor: Leon Bergmann
* Datum: 10.12.2012 12:31
* Update:
* License: LICENSE.txt
*/
class vertretungsplan
{
    
    /**
     * db
     * Storing the Databaseclass in the local Object
     * @var mixed
     * @access protected
     */
     
    protected $db;
    /**
     * _DATA
     * 
     * @var mixed
     * @access protected
     */
     
    protected $_DATA;
    
    /**
     * __construct function.
     * 
     * @access public
     * @param mixed $db
     * @return void
     */
     
    public function __construct($db,$_DATA)
    {
        if(empty($db))
        {
            throw new Exeception("No Database",3);
        }
        else
        {
            $this->db = $db;
        }
        
        $this->_DATA = $_DATA;
    }
    
    /**
     * convertDate function.
     * decoding the Timeformate
     * @access private
     * @param mixed $value
     * @param bool $day (default: false)
     * @param bool $hour (default: false)
     * @return array
     */
    private function convertDate($value,$day = false,$hour = false)
    {
        
        $wochentage = array(1=>"Montag",2=>"Dienstag",3=>"Mittwoch",4=>"Donnerstag",5=>"Freitag",6=>"Samstag",7=>"Sonntag");
				
		$timecodeSplit = explode('x', $timecode);
		if(empty($timecode) or $timecodeSplit[0] < 1 or $timecodeSplit[0] > 7 or $timecodeSplit[1] < 1 or  $timecodeSplit[1] > 12)
		{
			throw new Exeception("Eingabe fehlerhaft",3);
		}
			
		if($day)
		{
			$result 		= $wochentage[$timecodeSplit[0]];
		}
		elseif($hour)
		{
			$result			= $timecodeSplit[1];
		}
		else
		{
			$result['day']	= $wochentage[$timecodeSplit[0]];
			$result['hour']	= $timecodeSplit[1];
		}
		
		return $result;
    }
    
    /**
     * prepareData function.
     * ordering the data by the day and lesson
     * @access private
     * @return void
     */
     
    private function prepareData()
    {
       $_DATA	= $this->_DATA;
       $tmp		= array();
       
       foreach ($_DATA as $row) 
       {

	       	$result	=	convertDate($row['Date']);
	       	$array[$result['day'].'<br>'.$row['Datum']][$result['hour']][] = array('Fach' => $row['Fach'], 'Klasse' => $row['Klasse'], 'Lehrer' => $row['Lehrer'], 'Vertreter' => $row['Vertretung']  );

	   }
	   
	   $this->_DATA = $tmp;      
    }
    

    /**
     * generateOutput function.
     * generate Output in HTML for the site
     * @access private
     * @return string
     */
     
    private function generateOutput()
    {
	    $html = '<table><tr>';

		foreach ($array as $key_tag => $tag) 
		{
		
		    $html .= '<td><table border="1" border="black">
		            <tbody>
		            <tr>
		            <th>Stunden</th>
		            <th>'.$key_tag.'</th>
		            </tr>';
		            
		    foreach ($tag as $key_stunde => $stunde)
		    {
		    
		        $html .= '<tr>
		                <td>'.$key_stunde.'.</td>
		                <td>
		                    <table border="1" border="black">
		                    <tbody>
		                        <tr>
		                            <th>Klasse</th>
		                            <th>Lehrer</th>
		                            <th>Vertretung</th>
		                        </tr>';
		                        
		                        foreach ($stunde as $vertretung)
		                        {
		                        
		                            $html .= '<tr>
		                                        <td>'.$vertretung['Klasse'].'</td>
		                                        <td>'.$vertretung['Lehrer'].'</td>
		                                        <td>'.$vertretung['Vertreter'].'</td>
		                                    </tr>';
		                                    
		                        }
		                        
		        $html .=    '</tbody>
		                    </table>
		                </td>
		            </tr>';
		            
		    }
		            
		    $html .= '</tbody>
		            </table></td>';
		            
		}
		
		return  $html."</tr><table>"; 
    }
}
?>
