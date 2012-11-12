<?php
// Autor: Leon Bergmann
// Date: 12.11.2012 09:10 Uhr 

// Required Files
require_once("class.install.php");
require_once("../static/class.database.php");

// Begin Code
echo "<p>Making DB Connection</p>";

$db			= new database;
$install	= new installAPI;

echo "<p>Get Frist DatabaseSQL</p>";
$sql 		= $install->parseSQL("database.backend.sql");
/* $db->querySend($sql); */
echo "<p>Make backend Database</p>";

$install->removeGitFiles();
?>