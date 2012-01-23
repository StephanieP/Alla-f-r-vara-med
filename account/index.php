<?php
require_once ("../includes/FxS_Core.php");

//Om inte inloggad och inget id, skicka till inloggning
if (!is_numeric($URI->value(1)) && !$USER->is_logon()) {
	header("Location: /login/");
	exit;
}

$template = new AllaKan_Template;

// Om inget id är satt, anta inloggades id
$template->profile_login_id = is_numeric($URI->value(1)) ? $URI->value(1) : $USER->login_id;

// Har användaren rätt att editera?
$template->is_profile_admin = false;
if ($template->profile_login_id == $USER->login_id || $USER->is_privileged('user_admin')) {
	$template->is_profile_admin = true;
}

$profile = new FxS_Profile($template->profile_login_id, "l.login_username,p.profile_text");

$template->profile_username = $profile->get_username();
$template->profile_text 	= $profile->get_profile_text();
$template->title 			= "Mitt konto | Alla får vara med";

$template->display("account/profile.php");

?>