<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}

/********************************************************************************
 **Författare
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2011-06-15. Denna fil och 
 *	tillhörande filer får fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 ** INFO
 * Denna fil innehåller klassen FxS_Address_Uri
 *
 ** FUNKTIONER för FxS_Address_Uri
 *	__construct()
 *
 *	value($i)		- Heltal -> String
 *					  Retunerar det i:e värdet från adressen. (http://test.se/[i=0]/[i=1]/...)
 *
 *	previous()		- -> String
 *					  Retunerar föregående adress.
 *
 ********************************************************************************/

class FxS_Address_Uri {
	private $uri;
	private $values;
	private $previous;
	private $preprevious;
	
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
			return NULL;	
		}
		return $this->values[$i];
	}
	public function previous() {
		if (!isset($this->previous)) {
			return NULL;	
		}
		return $this->previous;
	}
}
?>