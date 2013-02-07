<?php
/*
* Autor: Leon Bergmann
* Datum: 06.02.2013 02:51
* Update:
* License: LICENSE.md
*/
session_start();
$_SESSION['id'] = 1234;
// define the Webroot to handel the includes more confable  
define(WEBROOT, dirname(__FILE__));
require_once(WEBROOT."/bin/class.api.php");
require_once(WEBROOT."/bin/app.settings.php");
try
{
	$api= new api($_POST,$_SESSION);
	echo json_encode($api->run(),JSON_FORCE_OBJECT);
}
catch(Exception $e)
{
	echo $e->getMessage();
}
?>
