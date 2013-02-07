<?php
/*
* Autor: Leon Bergmann
* Datum: 06.02.2013 02:42
* Update:
* License: LICENSE.md
*/
class api
{
	private $_data;
	private $_settings;
	private $asettings;
	private $news;
	
	public function __construct($data,$settings)
	{
		if(empty($data) or empty($settings))
		{
			throw new Exception("Empty view or empty action",1);
		}
		else
		{
			$this->_data 		= $data;
			$this->_settings	= $settings;
			 
		}
		$database			= database::singelton("coffee");
		$this->asettings 	= new settings;
		//$this->news		= news::getInstance();
	}
	
	public function run()
	{
		switch($this->_data['app'])
		{
				case "settings":
						return $this->asettings->get();
					break;
				case "dokuments":
					break;
				case "news":
					break;
				case "mail":
					break;
				case "stock":
		}
		
	}
}

?>
