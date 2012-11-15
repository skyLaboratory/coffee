<?php
//Autor: Patrick Kellenter
//Datum: 08.11.2012 - 17:30 Uhr
//Update: Leon Bergmann - 14.11.2012 11:54 Uhr 
require_once('classes/class.outputAPI.php');
$outputAPI = new outputAPI;
echo "<!DOCTYPE html>\n<html>\n<head>\n<link rel='stylesheet' href='style/cmsDokuStyle.css'>\n</head>\n<body>\n";

if(!isset($_GET['type']))
{
	$classesoutput = $outputAPI->showAsOption("classes");
	$functionsoutput = $outputAPI->showAsOption("functions");
	echo "<div id='head'>\n<h1>Dokumentation - Coffee</h1>\n</div>\n<div id='contentField'>\n";
	echo "<a href='index.php?action=addnewclass&type=class'>Neue Klasse anlegen</a>\n";
	echo "<a href='index.php?action=addnewfunction&type=function'>Neue Funktion anlegen</a>\n";
	echo "<div id='form'>\n";
	echo "<form action='' method='GET'>\n";
	echo "<ul>\n";
	echo "<input type ='hidden' name='type' value='class' />\n";
	echo "<input type ='hidden' name='action' value='edit' />\n";
	echo "<li>\n<select name='what'>\n";
	echo $classesoutput;
	echo "</select>\n";
	echo "<input type='submit' value='bearbeiten' />\n</li>\n</ul>\n</form>\n";
	echo "<form action='' method='GET'>\n";
	echo "<ul>\n";
	echo "<input type ='hidden' name='type' value='function' />\n<input type ='hidden' name='action' value='edit' />\n<li>\n<select name='what'>\n";
	echo $functionsoutput;
	echo "</select>\n";
	echo "<input type='submit' value='bearbeiten'/>\n</li>\n</ul>\n</form>\n";
	echo "</div>\n</div>\n";
}
else
{
	if(!isset($_GET['action']))
	{
		header('LOCATION: index.php');
		die();
	}
	else
	{
		$action = $_GET['action'];
	}
	
	$type = $_GET['type'];
	
	//Klassen
	if($type == 'class')
	{
		if($action == 'addnewclass')
		{
			echo "<div id='head'>";
			echo "<h1>Hinzufügen einer Klasse</h1></div>";
			echo "<div id='contentField'>";
			echo "<div id='form'>";
			echo "<form action='' method='POST'>";
			echo "<ul><li><label>Name der Klasse:</label><input type='text' name='name' /></li>";
			echo "<li><label>Version:</lable><input type='text' name='version' /></li>";
			echo "<li><label>Args:</label><input type='text' name='args' /></lu>";
			echo "<li><input type='submit' value='Neue Klasse anlegen' /></li>";
			echo "</form></div>";	
		}
		
		if($action == 'edit')
		{
			if($_GET['what'] == 'false')
			{
				header('LOCATION: index.php');
				die();
			}
			$info = $outputAPI->classesInfoFromDatabase($_GET['what']);
			
			echo "<div id='head'>";
			echo "<h1>Klasse bearbeiten - ".$info[0]."</h1>";
			echo "<div id='contentField'>";
			echo "<div id='form'>";
			echo "<form action='' method='POST'>";
			echo "<ul><li><label>Name der Klasse:</label><input type='text' name='name' value='".$info[0]."' /></li>";
			echo "<li><label>Version:</lable><input type='text' name='version' value='".$info[2]."' /></li>";
			echo "<li><label>Args:</label><input type='text' name='args' value='".$info[1]."' /></lu>";
			echo "<li><input type='submit' value='Klasse bearbeiten' /></li>";
			echo "</form></div>";
			die();
		}
	}
	
	//Funktionen
	if($type == 'function')
	{
		if($action == 'addnewfunction')
		{
			$classesoutput = $outputAPI->showAsOption("classes");
			echo "<h1>Hinzufügen einer Funktion</h1>";
			echo "<form action='' method='POST'>Bitte Klasse auswählen: <select>";
			echo "<option value='noClass'>Funktion keiner Klasse zuweisen</option>";
			echo $classesoutput;
			echo "</select>";
			echo "Name der Funktion: <input type='text' name='name' />";
			echo "Args: <input type='text' name='args' />";
			echo "Return-Wert(e) <input type='text' name='back' />";
			echo "Kurzbeschreibung: <textarea name='info' cols='50' rows='10'/></textarea>";
			echo "<input type='submit' value='Neue Funktion anlegen' /></form>";
			die();
		}
		
		if($action == 'edit')
		{
			if($_GET['what'] == 'false')
			{
				header('LOCATION: index.php');
				die();
			}
			$info = $outputAPI->functionsInfoFromDatabase($_GET['what']);
			
			echo "<h1>Function bearbeiten - ".$info[0]."</h1>";
			echo "Name der Funktion: <input type='text' name='name' value='".$info[0]."' />";
			echo "Args: <input type='text' name='args' value='".$info[1]."' />";
			echo "Return-Wert(e) <input type='text' name='back' value='".$info[3]."' />";
			echo "Kurzbeschreibung: <textarea name='info' cols='50' rows='10' />".$info[2]."</textarea>";
			echo "<input type='submit' value='Neue Daten speichern' /></form>";
			die();
		}
	}
	
	//header('LOCATION: index.php');
	//die();
}

echo "</body>\n</html>";

?>