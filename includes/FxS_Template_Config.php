<?php
// Kan enbart k�ras som FxS_core.php �r inkluderad f�re.
if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}

/*
 * FxS_template_config.php
 *
 * Class: AllaKan_Template
 *
 * Inneh�ller subklass av FxS_Template f�r att skapa standard
 * templates.
 */
 
 
class AllaKan_Template extends FxS_Template {
	public $header_file;
	public $footer_file;
	public function __construct() {
		global $USER;
		
		// Om ej definierad
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
