<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}

/********************************************************************************
 **Författare
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2012-01-22. Denna fil och 
 *	tillhörande filer får fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 ** INFO
 * Denna fil innehåller klassen AllaKan_Template, används för att separera html från
 * php på ett smidigt sätt.
 *
 * Läs mer om hur denna används i superklassen: FxS_Template (FxS_Template.php)
 *******************************************************************************/
 
 
class AllaKan_Template extends FxS_Template {
	public $header_file;
	public $footer_file;
	public function __construct() {
		$this->title 		= "Alla får vara med - Projekt";
		$this->css 			= array();
		$this->javascript 	= array();
		$this->template_dir = TEMPLATE_PATH;
		$this->header_file 	= isset($header_file) ? $header_file : "head.php";
		$this->footer_file 	= isset($footer_file) ? $footer_file : "foot.php";
	}
	
	public function display($template_file) {
		include($this->template_dir . $this->header_file);
		include($this->template_dir . $template_file);
		include($this->template_dir . $this->footer_file);
	}
}
