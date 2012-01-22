<?php
// Kan enbart köras om FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) { echo "Not allowed"; exit;}

/*
 * FxS_mysql_config.php
 *
 * Class: AllaKan_Mysql
 *
 * Innehåller subklass av FxS_Mysql för att skapa standard
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