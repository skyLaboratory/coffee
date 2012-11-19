<?php
// Autor: Florian Giller
// Date : 05.11.2012
// Update: Leon Bergmann - 16.11.2012 09:12 Uhr 
session_start();

require_once($_SERVER["DOCUMENT_ROOT"]."/coffee/static/class.database.php");

require_once("classes/class.user.php");
require_once("classes/class.view.php");
require_once("classes/class.teacher.php");
require_once("classes/class.faecher.php");


$view 		= new view();
$database	= new database();
$user 		= new userAdministration($database);
$teacher	= new teacher($database);
$subject	= new subject($database);

$database->databaseName = "backend";

$contentField = "<div id='content'>";

//Wenn User nicht eingeloggt

	//Wenn Loginbutton gedr&uuml;ckt
	if(isset($_POST['login']))
	{
		//Login Check
		$_SESSION['auth'] 	= true;
		$message 		= "Login erfolgreich";
	}
	if(isset($_GET['logout']))
	{		
		session_unset();
		$message 		= "Sie wurden ausgeloggt";

	}

	//Wenn garnichts gesetzt ist
	

//Wenn User eingeloggt
if($_SESSION['auth'] and !isset($_GET['dev']))
{
	$menu = "";
	$menu = $view->viewMenu();
	//ACTIONS
	switch($_GET['a'])
	{
		case "userAddSave":
			$userInfos = $_POST['user'];
			if($user->addUser($userInfos))
				$message 		= "Neuen Benutzer angelegt";
			break;
			
		case "userEditSave":
			$userInfos = $_POST['user'];
			$userInfos['id'] = $_GET['id'];
			if($user->editUser($userInfos))
				$message 		= "Benutzer ver&auml;ndert";
			break;
		case "userDelete":
			if($user->deleteUser($_GET['id']))
				$message 		= "Benutzer gel&ouml;scht";

			break;
		
		case "teacherAddSave":
			$data = $_POST['form'];
			if($teacher->addTeacher($data))
				$message 		= "Neuen Lehrer angelegt";

			break;
			
		case "teacherEditSave":
			$data 		= $_POST['form'];
			$data['id'] = $_GET['id'];
			if($teacher->editTeacher($data))
				$message 		= "Lehrer bearbeitet";
			break;
		
		case "teacherDelete":
			if($teacher->deleteTeacher($_GET['id']))
				$message 		= "Lehrer entfernt";

			break;
			
		case "subjectAddSave":
			$data = $_POST['form'];
			if($subject->addSubject($data))
				$message 		= "Neues Fach angelegt";

			break;
		case "subjectEditSave":
			$data 		= $_POST['form'];
			$data['id'] = $_GET['id'];
			if($subject->editSubject($data))
					$message 		= "Fach bearbeitet";
			break;
		
		case "subjectDelete":
			if($subject->deleteSubject($_GET['id']))
				$message 		= "Fach gel&oul;scht";
			break;

	}
	
	//VIEWS
	switch($_GET['v'])
	{
		case "userlist":
			$contentField 	.= "<h2>Benutzerverwaltung</h2><ul>";
			$contentField 	.= "<a href='?v=useradd'>Benutzer hinzuf&uuml;gen</a>";
			$contentField 	.= "<h3>Benutzerliste</h3><ul>";
			$contentField 	.= $view->viewUserList($user->listAllUsers());	
			break;

		case "useradd":
			$contentField 	.= "<h2>Benutzer anlegen</h2><ul>";
			$contentField 	.= $view->viewUserAddFormular();	
			break;

		case "useredit":
			$contentField 	.= "<h2>Benutzer bearbeiten</h2><ul>";
			$contentField 	.= $view->viewUserEditFormular($user->getUserDetails($_GET['id']));
			//$contentField 	.= $view->viewUserAddFormular();	
			break;

		case "teacherlist":
			$contentField 	.= "<h2>Lehrerverwaltung</h2><ul>";
			//$contentField 	.= "<h2>Benutzerhinzuf&uuml;gen</h2><ul>";
			$contentField 	.= "<a href='?v=teacheradd'>Lehrer hinzuf&uuml;gen</a>";
			$contentField 	.= "<h3>Lehrerliste</h3><ul>";
			$contentField 	.= $view->viewTeacherList($teacher->listAllTeacher());			
			break;

		case "teacheradd":
			$contentField 	.= "<h2>Lehrer hinzuf&uuml;gen</h2><ul>";
			$contentField 	.= $view->viewTeacherFormular(array());	
			break;

		case "teacheredit":
			$contentField 	.= "<h2>Lehrer bearbeiten</h2><div class='form'><ul>";
			$contentField 	.= $view->viewTeacherFormular($teacher->getTeacherDetails($_GET['id']));
			$contentField   .= view::viewTeacherFaecher($teacher->getAllFeacherForTeacher($_GET['id']));
			//$contentField 	.= $view->viewUserAddFormular();
			break;
			
		case "subjectlist":
			$contentField 	.= "<h2>F&auml;cherverwaltung</h2><ul>";
			$contentField 	.= "<a href='?v=subjectadd'>Fach hinzuf&uuml;gen</a>";
			$contentField 	.= "<h3>F&auml;cherliste</h3><ul>";
			$contentField 	.= $view->viewSubjectList($subject->listAllSubject());			
			break;

		case "subjectadd":
			$contentField 	.= "<h2>Fach hinzuf&uuml;gen</h2><ul>";
			$contentField 	.= $view->viewSubjectFormular(array());	
			break;

		case "subjectedit":
			$contentField 	.= "<h2>F&auml;cher bearbeiten</h2><ul>";
			$contentField 	.= $view->viewSubjectFormular($subject->getSubjectDetails($_GET['id']));
			//$contentField 	.= $view->viewUserAddFormular();
			break;
		case "teacher-subject":
			$contentField .= "<h2>Lehrer F&auml;cher zuordnen</h2>";
			/* $contentField .= $view->viewTeacherFaecherFormular(); */
			break;
			
		case "home":
		default:
			$contentField .= "<h2>Willkommen auf der Startseite</h2>";
			break;

	}
	
	//Weitere Funtionen wenn eingeloggt
	
	
	//$contentField .= "<li><a href='?logout'>Ausloggen<a/></li>";
}
else
{	
	//Loginpage
	$contentField .= $view->ViewLogin();

}

$contentField .= "</div>";
$output = $view->htmlHead;
$output .= $menu;
$output .= $view->messageBox($message);
$output .= $contentField;
$output .= $view->htmlBottom;

echo $output;
?>