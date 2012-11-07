<?php
//Autor: Patrick Kellenter
//Date: 06.11.2012 13:30 Uhr

class randomAPI
{
	public static function randomChars($laenge)
	{
		$inhalt='abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$string = "";
		srand(microtime()*1000000);
	
		for($i=1;$i<=$laenge;$i++)
		{
			$index	= rand(1,strlen($inhalt));
			$index--;
			$string	.= $inhalt{$index};
		}
		
		return $string;
	}
	
	public static function randomNumber($laenge)
	{
		$number = NULL;
		srand(microtime()*1000000);
		for($i=0; $i <= $laenge; $i++)
		{
			$tmp	 = rand(1,52);
			$number .= $tmp;
		}
		
		return $number;	
	}
}
?>