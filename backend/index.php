<?php
<<<<<<< HEAD
function __autoload($class_name)
{
	include(dirname(dirname(__FILE__))."/static/class.".$class_name.".php");
}

=======
require_once($_SERVER["DOCUMENT_ROOT"]."/coffee/static/class.database.php");
>>>>>>> database & user class update
require_once("classes/class.user.php");

$output = "<h1>Administration</h1>";

$database = new database();
$database->databaseName = "backend";


$user = new userAdministration($database);
$output .= $user->listAllUsers();


echo $output;
?>