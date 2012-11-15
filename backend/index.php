<?php
// Autor: Florian Giller
// Date : 05.11.2012

/*
function __autoload($class_name)
{
	include(dirname(dirname(__FILE__))."/static/class.".$class_name.".php");
}
*/
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


//Wenn User nicht eingeloggt

	//Wenn Loginbutton gedrückt
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
				$message 		= "Benutzer verändert";
			break;
		case "userDelete":
			if($user->deleteUser($_GET['id']))
				$message 		= "Benutzer gelöscht";

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
				$message 		= "Lehrer terminiert";

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
				$message 		= "Fach gelöscht";
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
			//$contentField 	.= "<h2>Benutzerhinzufügen</h2><ul>";
			$contentField 	.= "<a href='?v=teacheradd'>Lehrer hinzuf&uuml;gen</a>";
			$contentField 	.= "<h3>Lehrerliste</h3><ul>";
			$contentField 	.= $view->viewTeacherList($teacher->listAllTeacher());			
			break;

		case "teacheradd":
			$contentField 	.= "<h2>Lehrer hinzufügen</h2><ul>";
			$contentField 	.= $view->viewTeacherFormular(array());	
			break;

		case "teacheredit":
			$contentField 	.= "<h2>Lehrer bearbeiten</h2><ul>";
			$contentField 	.= $view->viewTeacherFormular($teacher->getTeacherDetails($_GET['id']));
			//$contentField 	.= $view->viewUserAddFormular();
			break;
			
		case "subjectlist":
			$contentField 	.= "<h2>Fächerverwaltung</h2><ul>";
			$contentField 	.= "<a href='?v=subjectadd'>Fach hinzuf&uuml;gen</a>";
			$contentField 	.= "<h3>Fächerliste</h3><ul>";
			$contentField 	.= $view->viewSubjectList($subject->listAllSubject());			
			break;

		case "subjectadd":
			$contentField 	.= "<h2>Fächer hinzufügen</h2><ul>";
			$contentField 	.= $view->viewSubjectFormular(array());	
			break;

		case "subjectedit":
			$contentField 	.= "<h2>Fächer bearbeiten</h2><ul>";
			$contentField 	.= $view->viewSubjectFormular($subject->getSubjectDetails($_GET['id']));
			//$contentField 	.= $view->viewUserAddFormular();
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
$output = $view->htmlHead;
$output .= $menu;
$output .= $view->messageBox($message);
$output .= $contentField;
$output .= $view->htmlBottom;

echo $output;
?>