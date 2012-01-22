<?php
// Kan enbart köras om FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {echo "Not allowed"; exit;}

/*
 * FxS_constants.php
 *
 * Definierar konstanter som kan användas över hela sajten där 
 * FxS_core.php är importerad.
 */

// Php
define("INCLUDE_PATH", dirname(__FILE__) . "/");
define("ROOT_PATH", dirname(INCLUDE_PATH) . "/");
define("CLASS_PATH", INCLUDE_PATH . "classes/");
define("TEMPLATE_PATH", ROOT_PATH . "templates/");

// Html
define("H_CSS_PATH", "/css/");
?>