<?php
//Autor: Patrick Kellenter
//Datum: 08.11.2012 - 17:30 Uhr
//Letztes Update: Patrick Kellenter - 13.11.2012 18:15 Uhr

require_once('classes/class.outputAPI.php');

echo "<!DOCTYPE html><html><head></head><body>";

if(!isset($_GET['type']))
{
	$classesoutput = outputAPI::showasoption("classes");
	$functionsoutput = outputAPI::showasoption("function");
	echo "<h1>Dokumentation - Coffee</h1><br />";
	echo "<a href='index.php?action=addnewclass&type=class'>Neue Klasse anlegen</a><br /><br />";
	echo "<a href='index.php?action=addnewfunction&type=function'>Neue Funktion anlegen</a><br /><br />";
	echo "<form action='' method='GET'>";
	echo "<input type ='hidden' name='type' value='class' /><input type ='hidden' name='action' value='edit' /><select name='what'>";
	if(empty($classesoutput))
	{
		echo "<option value=''>Keine Klassen vorhanden</option>";
	}
	else
	{
		echo $classesoutput;
	}
	echo "</select>";
	echo "<input type='submit' value='bearbeiten' /><br /><br /></form>";
	echo "<form action='' method='GET'>";
	echo "<input type ='hidden' name='type' value='function' /><input type ='hidden' name='action' value='edit' /><select name='what'>";
	if(empty($functionsoutput))
	{
		echo "<option value=''>Keine Funktionen vorhanden</option>";
	}
	else
	{
		echo $functionsoutput;
	}
	echo "</select>";
	echo "<input type='submit' value='bearbeiten'/><br /><br /></form>";
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
		
		if($action == 'edit' AND !empty($_GET['what']))
		{
			echo "<h1>Klasse bearbeiten - ".$_GET['what']."</h1><br />";
			echo "Bearbeiten in Arbeit";
			die();
		}
	}
	
	//Funktionen
	if($type == 'function')
	{
		if($action == 'addnewfunction')
		{
			$classesoutput = outputAPI::showasoption("classes");
			echo "<h1>Hinzufügen einer Funktion</h1><br />";
			echo "<form action='' method='POST'>Bitte Klasse auswählen: <select>";
			echo "<option value='noClass'>Funktion keiner Klasse zuweisen</option>";
			echo $classesoutput;
			echo "</select><br /><br />";
			echo "Name der Funktion: <input type='text' name='name' /><br /><br/>";
			echo "Args: <input type='text' name='args' /><br /><br/>";
			echo "Return-Wert(e) <input type='text' name='back' /><br /><br/>";
			echo "Kurzbeschreibung: <br /><textarea name='info' cols='50' rows='10'/></textarea><br /><br/>";
			echo "<input type='submit' value='Neue Funktion anlegen' /></form>";
			die();
		}
		
		if($action == 'edit' AND !empty($_GET['what']))
		{
			echo "<h1>Function bearbeiten - ".$_GET['what']."</h1><br />";
			echo "Bearbeiten in Arbeit";
			die();
		}
	}
	
	header('LOCATION: index.php');
	die();
}

echo "</body></html>";

?>