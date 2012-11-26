<?php /*
error_reporting(-1);
require_once("class.storeFunction.php");
$store = new storeFunction;
$args  = array();
$args['Value'][1] = "String";
$args['Name'][1]  = "Name";
$args['Value'][2] = "Number";
$args['Name'][2]  = "Number";
$store->safeAndValidateData("echo","Gibt eine Variable aus",1,1,1,"output of Value",1,1,$args,3,NULL);
$store->safeFunction(); */

require_once("class.storeFunction.php");

$store = new storeFunction;
$argsID = $store->existArg($args);


?>