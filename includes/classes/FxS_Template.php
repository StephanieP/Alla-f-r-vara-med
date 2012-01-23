<?php
// Kan enbart k�ras som FxS_core.php �r inkluderad f�re.
if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}

/********************************************************************************
 **F�rfattare
 *	Denna fil �r skapad av Felix Stridsberg, Link�ping, 2011-06-01. Denna fil och 
 *	tillh�rande filer f�r fritt anv�ndas f�r privat bruk.
 *	Utf�rliga guider f�r anv�ndning finns p�: http://webbprogrammering.ifokus.se
 *
 ** INFO
 * Denna fil inneh�ller klassen FxS_Template, anv�nds f�r att separera html fr�n
 * php p� ett smidigt s�tt.
 *
 ** FUNKTIONER f�r FxS_Template
 *	__construct()				- ->
 *
 *	display($template_file)		- Str�ng -> 
 *					  			  Inkluderar filen fr�n template-mappen.
 *
 ** EXEMPEL
 *
 * B�rja med att skapa en sub-klass f�r alla olika versioner av templates du vill
 * ha. Till exempel f�ljande som inkluderar en header, sedan inneh�llet och en footer 
 * n�r vi anropar funktionen display:
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
 * Nu kan vi skapa ett template s� h�r:
 *
 *>		$template = new Ex_Template;
 *
 * Sen kan vi skicka variabler till html-dokumentet s� h�r:
 *
 *>		$template->text  = $mysqlfr�ga->get_text();
 *
 * Och visa en specifik html-fil s� h�r:
 *
 *>		$template->display("fil.php");
 *
 * I html-filen kan vi komma �t alla variabler i php s� h�r:
 *
 *>		<?php global $template; ?>
 *>		<massa html>
 *>			Text fr�n php: <?php echo $template->text; ?>
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