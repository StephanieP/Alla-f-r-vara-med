<?php
// Kan enbart k�ras som FxS_core.php �r inkluderad f�re.
if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}

/*
 * FxS_mysql_config.php
 *
 * Class: AllaKan_Mysql
 *
 * Inneh�ller subklass av FxS_Mysql f�r att skapa standard
 * anslutning till databas.
 */

class AllaKan_Mysql extends FxS_Mysql{
	protected $dbuser = "";
	protected $dbpass = "";
	protected $dbhost = "";
	protected $dbname = "";
	
	public function __construct() {}
}

?>