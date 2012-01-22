<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}

/*
 * FxS_template_config.php
 *
 * Class: AllaKan_Template
 *
 * Innehåller subklass av FxS_Template för att skapa standard
 * templates.
 */
 
 
class AllaKan_Template extends FxS_Template {
	public $header_file;
	public $footer_file;
	public function __construct() {
		global $USER;
		
		// Om ej definierad
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
