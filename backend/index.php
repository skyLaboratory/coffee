<?php
/*
function __autoload($class_name)
{
	include(dirname(dirname(__FILE__))."/static/class.".$class_name.".php");
}
*/
session_start();

require_once($_SERVER["DOCUMENT_ROOT"]."/coffee/static/class.database.php");

require_once("classes/class.user.php");
require_once("classes/class.view.php");

$view = new view();
$database = new database();
$database->databaseName = "backend";
if(isset($_GET['logout']))
{		
	session_destroy();

}

$output = $view->htmlHead;
$contentField .= "<h1>Administration</h1>";

//Wenn User nicht eingeloggt
{
	//Wenn Loginbutton gedrückt
	if(isset($_POST['login']))
	{
		//Login Check
		$_SESSION['auth'] 	= true;
		$contentField 		.= "Login erfolgreich";
	}
	elseif(isset($_GET['logout']))
	{		
		$contentField .= "Willkommen auf der Startseite";

	}
	//Wenn garnichts gesetzt ist
	else
	{	
		//Loginpage
		$contentField .= $view->ViewLogin();

	}
}
//Wenn User eingeloggt
if($_SESSION['auth'] and !isset($_GET['dev']))
{
	
	if(isset($_GET['userlist']))
	{
		
		$user 			= new userAdministration($database);
		$contentField 	.= $user->listAllUsers();
		
	}

	else
	{
		$contentField .= "Willkommen auf der Startseite";
	}
}
$output .= $contentField;
$output .= $view->htmlBottom;

echo $output;
?>