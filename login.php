<?php
require_once("static/class.loginAPI.php");
$loginAPI = new loginAPI("backend");
$loginAPI->makeLogin("user","8uhbgt5");
echo "<pre>";
print_r($loginAPI);
echo "</pre>";
?>