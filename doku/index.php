<?php
//Autor: Patrick Kellenter
//Datum: 08.11.2012 - 17:30 Uhr
//Letztes Update: Patrick Kellenter - 12.11.2012 - 12:00 Uhr

//Herstellen Datenbankverbindung

echo "<!DOCTYPE html><html><head></head><body>";

if(!isset($_GET['type']))
{
	echo "<h1>Dokumentation - Coffee</h1><br />";
	echo "<form action='' method='GET'>";
	echo "<select name='action'><option value='addnewclass'>Neue class anlegen</option>";
	//ausgabe andere klassen
	echo "</select><input type ='hidden' name='type' value='class' />";
	echo "<input type='submit' value='>>>' /><br /><br /></form>";
	echo "<form action='?type=function' method='GET'>";
	echo "<select name='action'><option value='addnewfunction'>Neue function anlegen</option>";
	//ausgabe der Funktionen
	echo "</select><input type='submit' value='>>>'/><br /><br />";
	echo "<input type ='hidden' name='type' value='function' /></form>";
}
else
{
	$type = $_GET['type'];
	
	//Ausgabe "Hinzufuegen einer Klasse"
	if($type == 'addnewclass')
	{
		echo "<h1>Hinzufügen einer Klasse</h1>"
	}
}

echo "</body></html>";

?>