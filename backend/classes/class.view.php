<?php
class view
{
	public $htmlHead 	= "<html><head></head><body>";
	public $htmlBottom 	= "</body></body>";
	
	
	
	public function viewLogin()
	{
		
		$output = '<form action="" method="post">
		Username: <input type="text" name="username" /><br />
		Passwort: <input type="password" name="passwort" /><br />
		<input type="submit" name="login" value="Anmelden" />
		</form>';
		return $output;
	}




}

