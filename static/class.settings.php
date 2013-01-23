<?php
/*
* Autor: Leon Bergmann
* Datum: 21.01.2013 01:33
* Update:
* License: LICENSE.md
*/
final class settings
{
	/**
	 * instance
	 * 
	 * @var mixed
	 * @access public
	 * @static
	 */
	public static $instance;
	
	/**
	 * db
	 * 
	 * @var mixed
	 * @access public
	 */
	public $db;
	
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @param mixed $db
	 * @return void
	 */
	public function __construct($db)
	{
		session_start();
		$this->db = $db;
	}
	
	/**
	 * singelton function.
	 * 
	 * @access public
	 * @static
	 * @return void
	 */
	public static function singelton($db)
	{
		if(!isset(self::$instance))
		{
			self::$instance = new settings($db);
		}
	
		return self::$instance;
	} 
	
	/**
	 * setSession function.
	 * 
	 * @access public
	 * @param mixed $name
	 * @param mixed $value
	 * @return void
	 */
	public function setSession($name,$value)
	{
		$name				= md5($name);
		$_SESSION[$name]	= $value;
	}
	
	/**
	 * getSession function.
	 * 
	 * @access public
	 * @param mixed $name
	 * @return void
	 */
	public function getSession($name)
	{
		$name				= md5($name);
		return 				$_SESSION[$name];
	}
	
	/**
	 * setArrayToSession function.
	 * 
	 * @access public
	 * @param mixed $array
	 * @return void
	 */
	public function setArrayToSession($array)
	{
		if(!is_array($array))
		{
			throw new Exception();
		}
		
		foreach($array as $key=>$element)
		{
			$key				= md5($key);
			$_SESSION[$key] 	= $element;
		}
		
		return true;
	}
	
	/**
	 * setSettingsToSessions function.
	 * 
	 * @access public
	 * @return void
	 */
	public function setSettingsToSessions()
	{
		$settings 	= $this->db->queryAsAssoc("Select name,value from settings");
		$tmp 		= array();
		foreach($settings as $element)
		{
			$tmp[$element['name']] = $element['value'];
		}
		$this->setArrayToSession($tmp);
		unset($tmp,$settings);
	}
}
?>