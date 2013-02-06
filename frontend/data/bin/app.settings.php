<?php
/*
* Autor: Leon Bergmann
* Datum: 06.02.2013 02:12
* Update:
* License: LICENSE.md
*/

class settings
{
	public function get()
	{
		$data[0]['type']				= "form";
		$data[0]['name'] 				= "lf";
		$data[0]['id'] 					= "lf";
		$data[0]['cssClass']			= "form";
		$data[0]['method']				= "POST";
		$data[0]['sub'][0]['objType']	= "input";
		$data[0]['sub'][0]['type']		= "text";
		$data[0]['sub'][0]['value']		= "";
		$data[0]['sub'][0]['name']		= "tName";
		$data[0]['sub'][0]['cssClass']	= "textInput";
		$data[0]['sub'][0]['id']		= "tName";
		$data[0]['sub'][1]['objType']	= "input";
		$data[0]['sub'][1]['type']		= "submit";
		$data[0]['sub'][1]['value']		= "Speichern";
		$data[0]['sub'][1]['name']		= "Speichern";
		
		return $data;
	}
}
?>
