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
       
       $count	= count($_DATA);
       for($i = 0; $i < $count; $i++)
       {
	       $result	=	convertDate($array[$i]['Date']);
	       
	       $tmp[$result['day']][$result['hour']]['Datum']		= $_DATA[$i]['Datum'];
	       $tmp[$result['day']][$result['hour']]['Lehrer']		= $_DATA[$i]['Lehrer'];
	       $tmp[$result['day']][$result['hour']]['Fach']		= $_DATA[$i]['Fach'];
	       $tmp[$result['day']][$result['hour']]['Klasse']		= $_DATA[$i]['Klasse'];
	       $tmp[$result['day']][$result['hour']]['Vertretung'] 	= $_DATA[$i]['Vertretung'];
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
	    
	    $result = '<table class="mainTable"><tbody><tr><th>Stunden</th>';
	    $_DATA	= $this->_DATA;
		$Keys	= array_keys($_DATA);
		
		foreach($Keys as $key)
		{
			$tag	= $this->convertDate($key,true);
			$date	= $this->convertTime($_DATA[$key]['Datum']);
			$result .= '<th>'.$tag.'<br />'.$date.'</th>';
		}
		
		$result	.= '</tr>';
		
		foreach($Keys as $key)
		{
			$stunde	= $this->convertDate($key,false,true);
			$table	= $this->subTable($_DATA[$key]);
			$result .= '<tr>';
			$result .= '<td>'.$stunde.'</td>';
			$result .= '</tr>'
		}
    }
}
?>
