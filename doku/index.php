<?php
//Autor: Patrick Kellenter
//Datum: 08.11.2012 - 17:30 Uhr
//Update: Leon Bergmann - 14.11.2012 11:54 Uhr 
require_once('classes/class.outputAPI.php');
require_once('classes/class.storeFunction.php');
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
	echo "</div>\n";
	if(isset($_GET['error']))
	{
		switch($_GET['error'])
		{
			case 1;
				echo "<div class='message'>Funktion angelegt</div>";
				break;
			case 2;
				echo "<div class='error'>Fehler beim anlegen der Funktion</div>";
				break;
			case 3;
				echo "<div class='message'>Funktion geupdated</div>";
				break;
		}
	}
	
	echo "\n</div>\n";
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
			echo "<li><label>Args:</label><input type='text' name='args' /></li>";
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
			echo "<li><label>Args:</label><input type='text' name='args' value='".$info[1]."' /></li>";
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
			echo "<div id='head'>";
			echo "<h1>Hinzufügen einer Funktion</h1></div>";
			echo "<div id='contentField'>";
			echo "<div id='form'>";
			echo "<form action='?type=function&action=safefunction' method='POST'>Bitte Klasse auswählen: <select name='toClass'>";
			echo "<option value='noClass'>Funktion keiner Klasse zuweisen</option>";
			echo $classesoutput;
			echo "</select>";
			echo "<ul><li><label>Name der Funktion:</label> <input type='text' name='name' /></li>";
			echo "<li><label>Args:</label> <input type='text' name='args' /></li>";
			echo "<li><label>Return-Wert(e):</label> <input type='text' name='back' /></li>";
			echo "<li><label>Kurzbeschreibung:</label> <textarea name='info' cols='50' rows='10'/></textarea></li>";
			echo "<input type='submit' value='Neue Funktion anlegen' /></form></div>";
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
			
			$classesoutput = $outputAPI->showAsOption("functions",$_GET['what']);
			echo "<div id='head'>";
			echo "<h1>Funktion bearbeiten - ".$info[0]."</h1></div>";
			echo "<div id='contentField'>";
			echo "<div id='form'>";
			echo "<form action='?type=function&action=updatefunction' method='POST'>";
			echo "<input type='hidden' name='id' value='".$_GET['what']."' />";
			echo "<option value='noClass'>Funktion keiner Klasse zuweisen</option>";
			echo $classesoutput;
			echo "</select>";
			echo "<ul><li><label>Name der Funktion:</label> <input type='text' name='name' value='".$info[0]."' /></li>";
			echo "<li><label>Args:</label> <input type='text' name='args' value='".$info[1]."' /></li>";
			echo "<li><label>Return-Wert(e):</label> <input type='text' name='back' value='".$info[3]."' /></li>";
			echo "<li><label>Kurzbeschreibung:</label> <textarea name='info' cols='50' rows='10' />".$info[2]."</textarea></li>";
			echo "<input type='submit' value='Neue Daten speichern' /></form></div>";
			die();
		}
		
		if($action == 'safefunction')
		{
			$name = $_POST['name'];
			$args = $_POST['args'];
			$back = $_POST['back'];
			$info = $_POST['info'];
			
			$store = new storeFunction;
			
			if($_POST['toClass'] == 'noClass')
			{
				$toClass = NULL;
			}
			else
			{
				$toClass = $_POST['toClass'];
			}
			
			if($toClass == 'false')
			{
				header('LOCATION: index.php?error=2');
				die();
			}

			$store->safeAndValidateData($name,$info,$toClass,1,1,$back,1,1,$argsID,3,NULL);
			$store->safeFunction();
			
			header('LOCATION: index.php?error=1');
			die();
		}
		
		if($action == 'updatefunction')
		{
			$name = $_POST['name'];
			$args = $_POST['args'];
			$back = $_POST['back'];
			$info = $_POST['info'];
			$id = $_POST['id'];
			
			$store = new storeFunction;
			
			if($_POST['toClass'] == 'noClass')
			{
				$toClass = NULL;
			}
			else
			{
				$toClass = $_POST['toClass'];
			}
			
			if($toClass == 'false')
			{
				header('LOCATION: index.php?error=2');
				die();
			}

			$store->safeAndValidateData($name,$info,$toClass,1,1,$back,1,1,$argsID,3,true);
			echo $store->updateFunction();
		
			header('LOCATION: index.php?error=3');
			die();
		}
	}
}

echo "</body>\n</html>";

?>