<?php
// Kan enbart k�ras som FxS_core.php �r inkluderad f�re.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}

class FxS_Template {
	public $template_dir;
	public function __construct() {
		$this->template_dir = TEMPLATE_PATH;
		$this->css = array();
		$this->javascript = array();
	}
	
	public function clean_array($arr) {
		if (isset($arr) && is_array($arr)) {
			return $arr;
		}
		else {
			return array();	
		}
	}
	
	public function display($template_file) {
		include($this->template_dir . $template_file);
	}
}


?>