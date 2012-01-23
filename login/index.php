<?php
require_once ("../includes/FxS_Core.php");

$template = new AllaKan_Template;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
	
	try {
		if(!isset($_POST['username'], $_POST['password'])) {
			throw new FxS_Missing_Argument_Error;	
		}
		
		$USER->login($_POST['username'], $_POST['password']);
	}
	//Användarnamn eller lösenord saknas
	catch(FxS_Missing_Argument_Error $e) {
		$template->error = "Du måste fylla i alla fält...";
	}
	catch(FxS_Username_Error $e) {
		$template->error = "Användaren finns inte...";
	}
	catch(FxS_Password_Error $e) {
		$template->error = "Fel lösenord...";
	}
	catch(FxS_Login_Locked_Error $e) {
		$template->error = "Ditt konto är tyvärr låst...";
	}
}

// Om inloggad, skicka till start
if ($USER->is_logon()) {
	header("Location: /");	
}

$template->title = "Logga in | Alla får vara med";
$template->display("account/login.php");

?>