<?php
function __autoload($class_name)
{
	include(dirname(dirname(__FILE__))."/static/class.".$class_name.".php");
}

require_once("classes/class.user.php");

$database = new database();


$user 	  = new userAdministration($database);
echo $user->listAllUsers();
//$user->add()




?>