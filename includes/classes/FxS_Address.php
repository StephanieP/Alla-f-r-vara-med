<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
class FxS_Address_Uri {
	public $uri;
	public $values;
	public $previous;
	public $preprevious;
	
	public function __construct() {
		$this->uri = $_SERVER['REQUEST_URI'];
		
		foreach(explode("/", $this->uri) as $value) {
			
			if(!empty($value)) {
				$this->values[] = $value;
			}
		}
		
		$this->previous = "/";	
		$this->preprevious = "/";
		if (isset($_SESSION['fxs_uri']['current_page'])) {
			$this->previous = $_SESSION['fxs_uri']['current_page'];
		}
		if (isset($_SERVER['HTTP_REFERER'])) {
			$this->preprevious = $_SERVER['HTTP_REFERER'];
		}
		elseif (isset($_SESSION['fxs_uri']['last_page'])) {
			$this->preprevious = $_SESSION['fxs_uri']['last_page'];
		}
		if (!isset($_SESSION['fxs_uri']['current_page'])
		|| $_SESSION['fxs_uri']['current_page'] != $this->uri) {
			$_SESSION['fxs_uri']['last_page'] 		= $this->previous;
			$_SESSION['fxs_uri']['current_page'] 	= $this->uri;
		}
	}
	public function value($i) {
		if (!isset($this->values[$i])) {
			return FALSE;	
		}
		return $this->values[$i];
	}
}
?>