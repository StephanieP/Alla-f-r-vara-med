<?php
// Kan enbart k�ras som FxS_core.php �r inkluderad f�re.
if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}

/********************************************************************************
 **F�rfattare
 *	Denna fil �r skapad av Felix Stridsberg, Link�ping, 2012-01-22. Denna fil och 
 *	tillh�rande filer f�r fritt anv�ndas f�r privat bruk.
 *	Utf�rliga guider f�r anv�ndning finns p�: http://webbprogrammering.ifokus.se
 *
 ** INFO
 * Denna fil inneh�ller klassen AllaKan_Template, anv�nds f�r att separera html fr�n
 * php p� ett smidigt s�tt.
 *
 * L�s mer om hur denna anv�nds i superklassen: FxS_Template (FxS_Template.php)
 *******************************************************************************/
 
 
class AllaKan_Template extends FxS_Template {
	public $header_file;
	public $footer_file;
	public function __construct() {
		$this->title 		= "Alla f�r vara med - Projekt";
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
