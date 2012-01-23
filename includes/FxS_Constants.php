<?php
// Kan enbart köras om FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {echo "Not allowed"; exit;}

/********************************************************************************
 **Författare
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2012-01-22. Denna fil och 
 *	tillhörande filer får fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 ** INFO
 * Denna fil innehåller enbart konstanter.
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