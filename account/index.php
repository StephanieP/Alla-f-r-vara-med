<?php
require_once ("../includes/FxS_Core.php");

//Om inte inloggad, kasta till startsidan
if (!is_numeric($URI->value(1)) && !$USER->is_logon()) {
	header("Location: /");
	exit;
}

$profile_user_id = is_numeric($URI->value(1)) ? $URI->value(1) : $USER->login_id;

$template = new AllaKan_Template;


$profile = new FxS_Profile($profile_user_id);

$template->is_profile_admin = $profile_user_id == $USER->login_id ? true : false;
$template->profile_username = $profile->get_username();
$template->profile_text = $profile->get_profile_text();

$template->title = "Mitt konto | Alla får vara med";
$template->display("account/profile.php");

?>