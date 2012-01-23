<?php
/********************************************************************************
 **Författare
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2011-06-01. Denna fil och 
 *	tillhörande filer får fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 ** INFO
 * Denna fil är hjärtat i FxS php-galleri.
 * Denna fil ska ligga importerad högst upp i alla filer som 
 * använder sig av någon klass i FxS php-galleri.
 *
 *******************************************************************************/

session_start();
ob_start();

/*
 * Tillåter körning av andra filer.
 * Alla .php filer som inte får köras annat än via FxS_core.php 
 * ska innehålla följade rad:
 *
 *> if (!defined("_EXECUTE")){ echo "Not allowed!"; exit;}
 */
define("_EXECUTE", true);
 
/*
 * Salt för lösenord, ändring kräver omhashning av databas!
 *
 ** OBS! Dessa hash är inte samma som ligger publicerad. Ändras denna fil 
 ** måste projektledaren ställa in rätt hash innan den skickas till servern
 ** annars kommer inloggningen alltid att påstå att lösenorden är fel.
 */
$FXS_SALT1 = "5¤#yt&";
$FXS_SALT2 = "ABs+#'";

/*
 * Importerar konstanter och exceptionklasser
 */
require_once("FxS_Constants.php");
require_once(CLASS_PATH . "FxS_Exceptions.php");

/*
 * Anslut till databas
 */
require_once(CLASS_PATH . "FxS_Mysql.php");
require_once(INCLUDE_PATH . "FxS_Mysql_Config.php");
$MYSQL = new AllaKan_Mysql;
$MYSQL->connect();	//Anslutning krävs för FxS_Security

/*
 * Importerar FxS php-galleri
 */
require_once(CLASS_PATH . "FxS_Security.php");
require_once(CLASS_PATH . "FxS_User.php");
require_once(CLASS_PATH . "FxS_Profile.php");
require_once(CLASS_PATH . "FxS_Address.php");
require_once(CLASS_PATH . "FxS_Template.php");
require_once(CLASS_PATH . "FxS_String.php");
require_once(CLASS_PATH . "FxS_Pageing.php");
require_once(INCLUDE_PATH . "FxS_Template_Config.php");

/*
 * $URI hanterar adressfältet. All åtkomst av variabler måste ske genom $URI!
 * Läs mer i FxS_Address.php
 */
$URI   = new FxS_Address_Uri;

/*
 * $USER hanterar inloggad användare. All information om användera hämtas från 
 * denna variabel, INTE från $_SESSIONER.
 */
$USER  = new FxS_User($MYSQL);
?>