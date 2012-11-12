<?php
//Autor: Patrick Kellenter
//Datum: 08.11.2012 - 17:30 Uhr

//Herstellen Datenbankverbindung

echo "<!DOCTYPE html><html><head></head><body>";
echo "<h1>Dokumentation - Coffee</h1><br />";
echo "<form action='' method='GET'>";
echo "<select name='action'><option value='addnewclass'>Neue class anlegen</option></select>";
echo "<input type ='hidden' name='type' value='class' />";
echo "<input type='submit' value='>>>' /><br /><br /></form>";
echo "<form action='?type=function' method='GET'>";
echo "<select name='action'><option value='addnewfunction'>Neue function anlegen</option></select><input type='submit' value='>>>'/><br /><br />";
echo "<input type ='hidden' name='type' value='function' />";
echo "</form></body></html>";
?>