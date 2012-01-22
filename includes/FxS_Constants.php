<?php
// Kan enbart k�ras om FxS_core.php �r inkluderad f�re.
if (!defined("_EXECUTE")) {echo "Not allowed"; exit;}

/*
 * FxS_constants.php
 *
 * Definierar konstanter som kan anv�ndas �ver hela sajten d�r 
 * FxS_core.php �r importerad.
 */

// Php
define("INCLUDE_PATH", dirname(__FILE__) . "/");
define("ROOT_PATH", dirname(INCLUDE_PATH) . "/");
define("CLASS_PATH", INCLUDE_PATH . "classes/");
define("TEMPLATE_PATH", ROOT_PATH . "templates/");

// Html
define("H_CSS_PATH", "/css/");
?>