<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}

/********************************************************************************
 **Författare
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2011-06-01. Denna fil och 
 *	tillhörande filer får fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 ** INFO
 * Denna fil innehåller klassen FxS_Template, används för att separera html från
 * php på ett smidigt sätt.
 *
 ** FUNKTIONER för FxS_Template
 *	__construct()				- ->
 *
 *	display($template_file)		- Sträng -> 
 *					  			  Inkluderar filen från template-mappen.
 *
 ** EXEMPEL
 *
 * Börja med att skapa en sub-klass för alla olika versioner av templates du vill
 * ha. Till exempel följande som inkluderar en header, sedan innehållet och en footer 
 * när vi anropar funktionen display:
 *
 *>		class Ex_Template extends FxS_Template {
 *>			public $header_file;
 *>			public $footer_file;
 *>			public function __construct() {
 *>				$this->title 		= "Exempel - Projekt";
 *>				$this->css 			= array();
 *>				$this->javascript 	= array();
 *>				$this->template_dir = TEMPLATE_PATH;
 *>				$this->header_file 	= isset($header_file) ? $header_file : "head.php";
 *>				$this->footer_file 	= isset($footer_file) ? $footer_file : "foot.php";
 *>			}
 *>			
 *>			public function display($template_file) {
 *>				include($this->template_dir . $this->header_file);
 *>				include($this->template_dir . $template_file);
 *>				include($this->template_dir . $this->footer_file);
 *>			}
 *>		}
 *
 * Nu kan vi skapa ett template så här:
 *
 *>		$template = new Ex_Template;
 *
 * Sen kan vi skicka variabler till html-dokumentet så här:
 *
 *>		$template->text  = $mysqlfråga->get_text();
 *
 * Och visa en specifik html-fil så här:
 *
 *>		$template->display("fil.php");
 *
 * I html-filen kan vi komma åt alla variabler i php så här:
 *
 *>		<?php global $template; ?>
 *>		<massa html>
 *>			Text från php: <?php echo $template->text; ?>
 *>		</massa html>
 *
 ********************************************************************************/

class FxS_Template {
	public $template_dir;
	public function __construct() {
		$this->template_dir = TEMPLATE_PATH;
		$this->css = array();
		$this->javascript = array();
	}
	
	public function display($template_file) {
		include($this->template_dir . $template_file);
	}
}


?>