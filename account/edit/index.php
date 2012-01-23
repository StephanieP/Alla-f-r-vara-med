<?php
require_once ("../../includes/FxS_Core.php");

//Om inte inloggad, kasta till startsidan
if (!$USER->is_logon()) {
	header("Location: /");
	exit;
}

$template = new AllaKan_Template;

// Om inget id är angett, ta inloggad användares id
$template->profile_login_id = is_numeric($URI->value(3)) ? $URI->value(3) : $USER->login_id;

// Har användaren rätt att editera?
$template->is_profile_admin = false;
if ($template->profile_login_id == $USER->login_id || $USER->is_privileged('user_admin')) {
	$template->is_profile_admin = true;
}

// Skicka till profil om inte rätt att editera
if (!$template->is_profile_admin) {
	header("Location: /account/" . $template->profile_login_id . "/");
	exit;
}

//Om postat
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (isset($_POST['profile_text'])) {
		$profile->set_profile_text($_POST['profile_text']);
		header("Location: /account/" . $template->profile_login_id . "/");
		exit;
	}
}

// Vad ska editeras?
$edit_value = $URI->value(2);

$profile = new FxS_Profile($template->profile_login_id, "l.login_username,p.profile_text");

$template->profile_username = $profile->get_username();
$template->profile_text 	= $profile->get_profile_text();
$template->title 			= "Mitt konto | Alla får vara med";

if ($edit_value == "text") {
	$template->display("account/edit/text.php");
}
else {
	$template->display("account/profile.php");
}

?>