<?php
// Kan enbart k�ras om FxS_core.php �r inkluderad f�re.
if (!defined("_EXECUTE")) {echo "Not allowed"; exit;}

/********************************************************************************
 **F�rfattare
 *	Denna fil �r skapad av Felix Stridsberg, Link�ping, 2012-01-22. Denna fil och 
 *	tillh�rande filer f�r fritt anv�ndas f�r privat bruk.
 *	Utf�rliga guider f�r anv�ndning finns p�: http://webbprogrammering.ifokus.se
 *
 ** INFO
 * Denna fil inneh�ller enbart konstanter.
 *
 *******************************************************************************/

// Php
define("INCLUDE_PATH", dirname(__FILE__) . "/");
define("ROOT_PATH", dirname(INCLUDE_PATH) . "/");
define("CLASS_PATH", INCLUDE_PATH . "classes/");
define("TEMPLATE_PATH", ROOT_PATH . "templates/");

// Html
define("H_CSS_PATH", "/css/");
?>