<?php
// Autor: Florian Giller
// Date: 13.11.2012 21:20 Uhr
// Update: Leon Bergmann - 15.11.2012 23:00 Uhr  
class view
{
	public $htmlHead 	= '<!DOCTYPE html>
	<html lang="de-DE">
	<head>
	<meta http-equiv="Content-Type" content="text/html">
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="style_backend.css" type="text/css">
	</head>
	<body>';
	
	public $htmlBottom 	= '</body></html>';
	
	
	
	public function viewLogin()
	{
		
		$output = '<form action="?" method="post">
		Username: <input type="text" name="username" /><br />
		Passwort: <input type="password" name="passwort" /><br />
		<input type="submit" name="login" value="Anmelden" />
		</form>';
		return $output;
	}

	public function viewMenu()
	{
		
		$output = '
		<div id="head">
		<div class="menu">
		<ul>
		<li><a href="?v=home">Startseite</a></li>
		<li><a href="?v=userlist">Benutzerverwalten</a></li>
		<li><a href="?v=teacherlist">Lehrerverwaltung</a></li>
		<li><a href="?v=subjectlist">Fächerverwaltung</a></li>
		<li><a href="?v=teacher-subject">Lehrer-Fächer-Zuordnung</a></li>
		<li><a href="?logout">Logout</a></li>
		</ul>
		</div>
		</div>';
		return $output;
		
	}

	public function messageBox($message)
	{
		if(empty($message)) return;
		$output = '<div class="info">'.$message.'</div>';
       /*
 <div class="success">Successful operation message</div>
        <div class="warning">Warning message</div>
        <div class="error">Error message</div>';
*/
		return $output;
		
	}


	public function viewUserAddFormular()
	{
		
		$output = '<form action="?v=userlist&a=userAddSave" method="post">
		Username: <input type="text" name="user[name]" /><br />
		Email: <input type="text" name="user[email]" /><br />
		Passwort: <input type="password" name="user[passwort1]" /><br />
		Passwort wiederholen: <input type="password" name="user[passwort2]" /><br />
		<input type="submit" name="userAdd" value="Speichern" />
		</form>';
		return $output;
	}
	public function viewUserEditFormular($userDetails)
	{
		
		$output = '<form action="?v=userlist&a=userEditSave&id='.$userDetails['id'].'" method="post">
		Username: <input type="text" name="user[name]" value="'.$userDetails['name'].'"/><br />
		Email: <input type="text" name="user[email]" value="'.$userDetails['email'].'"/><br />
		Passwort: <input type="password" name="user[passwort1]" /><br />
		Passwort wiederholen: <input type="password" name="user[passwort2]" /><br />
		<button type="submit" class="button" name="userEdit">Speichern</button>
		</form>';
		return $output;
	}
	public function viewUserList($userArray)
	{
				
		$table = "<table>\n";
		$table .= "<tr>\n";
		//NR Spalte erzeugen
		//$table .= "<th><h4>Nr.</h4></th>\n";
		//Tielspalten erzeugen
		$table .= "<th><h4>Name</h4></th>\n";		
		$table .= "<th><h4>E-Mail</h4></th>\n";	
		$table .= "<th><h4></h4></th>\n";	
		$table .= "</tr>\n";
		$table .= "</tr>\n";
		
		foreach($userArray as $userInfos)
		{
			$table .= "<tr>\n";
			$table .= "<td>".$userInfos['name']."</td>\n";
			$table .= "<td>".$userInfos['email']."</td>\n";
			$table .= "<td><a href = '?v=useredit&id=".$userInfos['id']."'>bearbeiten</a></td>\n";
			$table .= "<td><a onclick='if(!confirm(\"Eintrag von ".$userInfos['name']." entfernen?\")) return false;' href = '?v=userlist&a=userDelete&id=".$userInfos['id']."' >entfernen</a></td>\n";

			$table .= "</tr>\n";

		}
		
		$table .= "</table>\n";	


		return $table;
	}
	public function viewTeacherList($userArray)
	{
		if(empty($userArray)) return "Kein Lehrer eingetragen.";
		
		$table = "<table>\n";
		$table .= "<tr>\n";
		//NR Spalte erzeugen
		//$table .= "<th><h4>Nr.</h4></th>\n";
		//Tielspalten erzeugen
		$table .= "<th><h4>Vorname</h4></th>\n";	
		$table .= "<th><h4>Name</h4></th>\n";	
		$table .= "<th><h4>Kürzel</h4></th>\n";		
		$table .= "<th><h4>E-Mail</h4></th>\n";	
		$table .= "<th><h4></h4></th>\n";	
		$table .= "</tr>\n";
		
		foreach($userArray as $userInfos)
		{
			$table .= "<tr>\n";
			$table .= "<td>".$userInfos['vorname']."</td>\n";
			$table .= "<td>".$userInfos['name']."</td>\n";
			$table .= "<td>".$userInfos['kuerzel']."</td>\n";
			$table .= "<td>".$userInfos['email']."</td>\n";
			$table .= "<td><a href = '?v=teacheredit&id=".$userInfos['id']."'>bearbeiten</a></td>\n";
			$table .= "<td><a onclick='if(!confirm(\"Eintrag von ".$userInfos['name']." entfernen?\")) return false;' href = '?v=teacherlist&a=teacherDelete&id=".$userInfos['id']."' >entfernen</a></td>\n";

			$table .= "</tr>\n";

		}
		
		$table .= "</table>\n";	


		return $table;
	}
	
	
	public function viewTeacherFormular($data)
	{
			
		if(!empty($data)) 	$action = "teacherEditSave&id=".$data['id'];
		else				$action = "teacherAddSave";
		$output = '<form action="?v=teacherlist&a='.$action.'" method="post">
		<li><label>Vorname:</label><input type="text" name="form[vorname]" value="'.$data['vorname'].'"/></li>
		<li><label>Nachname:</label><input type="text" name="form[name]" value="'.$data['name'].'"/></li>		
		<li><label>Kürzel:</label><input type="text" name="form[kuerzel]" value="'.$data['kuerzel'].'"/></li>
		<li><label>E-Mail:</label><input type="text" name="form[email]" value="'.$data['email'].'"/></li>		
		<button type="submit" class="formbutton" name="userEdit">Speichern</button>
		</form>
		</ul>
		</div>';
		return $output;
		
	}
	
	public static function viewTeacherFaecher($dataArray)
	{
		if(!is_array($dataArray))
		{
			return false;
		}
		else
		{
			$tabel  = "<table>";
			$tabel .= "<tr>";
			$tabel .= "<th><h4>Fach</h4></th>";
			$tabel .= "<th><h4>Stunde</h4></th>";
			$tabel .= "</tr>";
			
			foreach($dataArray as $element)
			{
				$tabel .= "<tr>";
				$tabel .= "<td>".$element['fach']."</td>";
				$tabel .= "<td>".@$element['stunde']."</td>";
				$tabel .= "</tr>";
			}
			
			$tabel .= "</table>";
			return $tabel;
		}
	}
	
	public function viewSubjectList($userArray)
	{
		if(empty($userArray)) return "Kein Fach eingetragen.";
		
		$table = "<table>\n";
		$table .= "<tr>\n";
		//NR Spalte erzeugen
		//$table .= "<th><h4>Nr.</h4></th>\n";
		//Tielspalten erzeugen
		$table .= "<th><h4>Name</h4></th>\n";	
		$table .= "<th><h4>Kürzel</h4></th>\n";		
		$table .= "<th><h4>Beschreibung</h4></th>\n";	
		$table .= "<th><h4></h4></th>\n";	
		$table .= "</tr>\n";
		
		foreach($userArray as $userInfos)
		{
			$table .= "<tr>\n";
			$table .= "<td>".$userInfos['name']."</td>\n";
			$table .= "<td>".$userInfos['kuerzel']."</td>\n";
			$table .= "<td>".$userInfos['beschreibung']."</td>\n";
			$table .= "<td><a href = '?v=subjectedit&id=".$userInfos['id']."'>bearbeiten</a></td>\n";
			$table .= "<td><a onclick='if(!confirm(\"Eintrag ".$userInfos['name']." entfernen?\")) return false;' href = '?v=subjectlist&a=subjectDelete&id=".$userInfos['id']."' >entfernen</a></td>\n";

			$table .= "</tr>\n";

		}
		
		$table .= "</table>\n";	


		return $table;
	}
	
	
	public function viewSubjectFormular($data)
	{
			
		if(!empty($data)) 	$action = "subjectEditSave&id=".$data['id'];
		else				$action = "subjectAddSave";
		$output = '<form action="?v=subjectlist&a='.$action.'" method="post">
		<li><label>Name:</label><input type="text" name="form[name]" value="'.$data['name'].'"/></li>		
		<li><label>Kürzel:</label><input type="text" name="form[kuerzel]" value="'.$data['kuerzel'].'"/></li>
		<li><label>Beschreibung:</label><input type="text" name="form[beschreibung]" value="'.$data['beschreibung'].'"/></li>		
		<input type="submit" name="subjectAdd" value="Speichern" />
		</form>';
		return $output;
		
	}
	
}

