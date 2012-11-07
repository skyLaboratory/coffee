<?php
//Autor: Patrick Kellenter
//Update: Leon Bergmann 20 - 34
class replaceAPI
{
	private $string;
	private $replace;
	private $search;
	
	public function __construct($content,$replace,$search)
	{
		$this->content	= $content;
		$this->replace	= $replace;
		$this->search	= $search;
		
		return true;
		
	}
		
	public function slashHandelInternal($text)
	{
		$text = $this->stringReplace("'",'"',$text);
		$text = addslashes($text);
		
		return $text;
	}
	
	public function convertChars($text)
	{
		$text = htmlspecialchars($string);
		
		return $text;
	}
	
	public function stringReplace()
	{
		$tmp = str_replace($this->search,$this->replace,$this->content);

		return $tmp;
	}

 
}
?>