<?php
// Autor: Leon Bergmann
// Date: 07.11.2012 19:48 Uhr 
class iniAPI
{
	public $webRoot = false;
	
	public function __construct()
	{
		$this->webRoot = dirname(dirname(__FILE__));
	}
	
	public static function includeStatic()
	{
		if(ini_set('include_path',dirname(dirname(__FILE__))."/static/")) return true;
		else return true;
	}
	
	public static function _includeFrontend()
	{
		if(ini_set('include_path',dirname(dirname(__FILE__))."/frontend/")) return true;
		else return true;
	}
	
	public static function _includeBackend()
	{
		if(ini_set('include_path',dirname(dirname(__FILE__))."/backend/")) return true;
		else return true;
	}
	
	public static function _errorReportion($value)
	{
		error_reporting($value);
	}
}

?>