<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
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