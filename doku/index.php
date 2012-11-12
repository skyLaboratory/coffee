<?php
//Autor: Patrick Kellenter
//Datum: 08.11.2012 - 17:30 Uhr
//Letztes Update: Patrick Kellenter - 12.11.2012 - 12:00 Uhr

require_once('classes/class.outputAPI.php');

echo "<!DOCTYPE html><html><head></head><body>";

if(!isset($_GET['type']))
{
	//$classesoutput = databaseAPI::showasoptions("classes");
	//$functionsoutput = databaseAPI::showasoptions("function");
	echo "<h1>Dokumentation - Coffee</h1><br />";
	echo "<form action='' method='GET'>";
	echo "<select name='action'><option value='addnewclass'>Neue class anlegen</option>";
	if(empty($classesoutput))
		{
			echo "<option>Keine Klassen vorhanden</option>";
		}
		else
		{
			//Anzeige der Klassen
		}
	echo "</select><input type ='hidden' name='type' value='class' />";
	echo "<input type='submit' value='>>>' /><br /><br /></form>";
	echo "<form action='?type=function' method='GET'>";
	echo "<select name='action'><option value='addnewfunction'>Neue function anlegen</option>";
	if(empty($functionsoutput))
		{
			echo "<option>Keine Funktionen vorhanden</option>";
		}
		else
		{
			//Anzeige der Funktionen
		}
	echo "</select><input type ='hidden' name='type' value='function' />";
	echo "<input type='submit' value='>>>'/><br /><br /></form>";
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
			echo "<h1>Hinzufügen einer Klasse</h1><br />";
			echo "<form action='' method='POST'>";
			echo "Name der Klasse: <input type='text' name='name' /><br /><br />";
			echo "Version: <input type='text' name='version' /><br /><br />";
			echo "Args: <input type='text' name='args' /><br /><br />";
			echo "<input type='submit' value='Neue Klasse anlegen' />";
			echo "</form>";
			
			die();
		}
	}
	
	//Funktionen
	if($type == 'function')
	{
		if($action == 'addnewfunction')
		{
			//$functionsoutput = databaseAPI::showasoptions("function");
			echo "<h1>Hinzufügen einer Funktion</h1><br />";
			echo "<form action='' method='POST'>Bitte Klasse auswählen: <select>";
			echo "<option value='noClass'>Funktion keiner Klasse zuweisen</option>";
			echo "</select><br /><br />";
			echo "Name der Funktion: <input type='text' name='name' /><br /><br/>";
			echo "Args: <input type='text' name='args' /><br /><br/>";
			echo "Return-Wert(e) <input type='text' name='back' /><br /><br/>";
			echo "Kurzbeschreibung: <br /><textarea name='info' cols='50' rows='10'/></textarea><br /><br/>";
			echo "<input type='submit' value='Neue Funktion anlegen' /></form>";
			
			die();
		}
	}
	
	header('LOCATION: index.php');
	die();
}

echo "</body></html>";

?>