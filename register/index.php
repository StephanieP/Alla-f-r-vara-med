<?php
require_once ("../includes/FxS_Core.php");

$template = new AllaKan_Template;

// Om formulär postat, försök registrera
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	try {
		if (!isset($_POST['username'], $_POST['password'], $_POST['password_verify'])) {
			throw new FxS_Missing_Argument_Error;
		}
		if ($_POST['password'] != $_POST['password_verify']) {
			throw new FxS_Not_Match_Error;
		}
		
		$USER->register($_POST['username'], $_POST['password']);
	}
	// Användarnamn eller lösenord fattas
	catch (FxS_Missing_Argument_Error $e) {
		$template->error = "Du måste fylla i alla fält...";
	}
	// Lösenorden matchar inte
	catch (FxS_Not_Match_Error $e) {
		$template->error = "Lösenorden ska vara lika...";
	}
	// Ogiltiga tecken i användarnamn
	catch (FxS_Validation_Char_Error $e) {
		$template->error = "Användarnamnet får innehålla bokstäver, siffror och understreck...";
	}
	// Ogiltig längd på användarnamn
	catch (FxS_Username_Error $e) {
		$template->error = "Användarnamnet måste vara mellan 4 och 20 tecken långt...";
	}
	// Lösenord för kort
	catch (FxS_Password_Error $e) {
					echo $e . "ss";
		$template->error = "Lösenordet måste vara minst 4 tecken långt...";
	}
	// Användarnamnet är upptaget
	catch (FxS_Dublicate_Entery_Error $e) {
		$template->error = "Användarnamnet är tyvärr upptaget...";
	}
}

// Om inloggad (automatiskt inloggad vid registrering) skicka till startsidan.
if ($USER->is_logon()) {
	header("Location: /");	
}

$template->title = "Bli medlem | Alla kan";
$template->display("account/register.php");

?>