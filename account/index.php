<?php
require_once ("../includes/FxS_Core.php");

//Om inte inloggad, kasta till startsidan
if (!$USER->is_logon()) {
	header("Location: /");	
}

$template = new AllaKan_Template;



$template->title = "Mitt konto | Alla får vara med";
$template->display("account/profile.php");

?>