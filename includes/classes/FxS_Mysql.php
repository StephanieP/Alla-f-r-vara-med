<?php
/*****************************************************************************************
****NEW count_rows()
*
 **Författare
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2011-06-10. Denna fil och 
 *	tillhörande filer får fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 *
 **INFO
 *	Denna fil innehåller 2 st klasser FxS_Mysql och FxS_Query. Dessa används för att 
 *	hantera databaser på ett mycket enkelt sätt via objektorienterad PHP.
 *
 *
 **FUNKTIONER för FxS_Mysql
 *	__construct($dbhost,	- Konstruktorn tar fyra strängar för att 
 *				$dbuser,	ansluta till databasen: Databashost, 
 *				$dbpass,	databasanvändare, databaslösenord och 
 *				$dbname)	databasens namn.
 *
 * connect()				- Skapar anslutning eller letar reda på befintlig 
 *							anslutning till vald databas.
 *
 * execute($sqlquery)		- Tar en sträng som argument, kör queryn och retunerar
 *							FxS_Query-objekt.
 *															
 * 
 **FUNKTIONER för FxS_Query
 * __construct($query, 		- Konstruktorn har två parametrar. Första mysq_query
 *			   $dbconn)		och andra databasanslutning.
 *
 * fetch_row()				- Retunerar en rad i taget som en array.
 *
 * fetch_assoc()			- Retunerar en rad i taget som en associerad array.
 *
 * fetch_all()				- Retunerar alla rader som associerade arrayer i en array.
 *
 *
 *
 **EXCEPTIONS
 *	FxS_Mysql
 *		FxS_Mysql_Error		- Om något går fel vid anslutning till databas eller vid query-fel.
 *
 *	FxS_Query
 *		FxS_Mysql_Error		- Om databasanslutningen förloras innan objektet FxS_Query är skapat.
 *
 *
 **EXEMPEL
 *	Hämta användaren Felix från tabellen login
 *
 *>		$mysql = new FxS_Mysql("localhost", "FxSuser", "FxSpass", "FxSDatabas");
 *>		$query = $mysql->execute("SELECT * FROM login WHERE username = 'Felix'");
 *>		$user = $query->fetch_row();
 *
 *
 *	Skapa subclass för att slippa skriva inloggningsinformation
 *	(Skapas förslagsvis längst ner i denna fil)
 *
 *>		class MysqlConn extends FxS_Mysql {
 *>			protected $dbuser = "FxSuser";
 *>			protected $dbpass = "FxSpass";
 *>			protected $dbhost = "localhost";
 *>			protected $dbname = "FxSDatabas";
 *>			public function __construct() {}
 *>		}
 *
 *	Sen anropas sql-frågorna så här istället:
 *
 *>		$mysql = new MysqlConn;
 *>		$query = $mysql->execute("SELECT * FROM login WHERE username = 'Felix'");
 *>		$user = $query->fetch_row();
 *
 ******************************************************************************************/
 // Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
class FxS_Mysql {
	protected $dbconn;
	protected $dbhost;
	protected $dbuser;
	protected $dbpass;
	protected $dbname;
	
	public function __construct($dbhost, $dbuser, $dbpass, $dbname) {
		$this->dbhost = $dbhost;
		$this->dbuser = $dbuser;
		$this->dbpass = $dbpass;
		$this->dbname = $dbname;
	}
	
	public function connect() {
		$this->dbconn = mysql_pconnect($this->dbhost, 
									   $this->dbuser, 
									   $this->dbpass);
		
		if (!is_resource($this->dbconn)) {
			throw new FxS_Mysql_Error("Can't connect to database.");	
		}
		
		if (!mysql_select_db($this->dbname, $this->dbconn)) {
			throw new FxS_Mysql_Error("Can't select database.");	
		}
		
		mysql_set_charset('utf8',$this->dbconn); 
	}
	
	public function execute($sqlquery) {
		if (!is_resource($this->dbconn)) {
			$this->connect();	
		}
		
		$query = mysql_query($sqlquery, $this->dbconn)or die(mysql_error());
		
		if (!$query) {
			throw new FxS_Mysql_Error("Mysql error on execute.".mysql_error());
		}
		else if(!is_resource($query)) {
			return TRUE;			
		}
		return new FxS_Query($query, $this->dbconn);
	}
}

class FxS_Query {
	protected $dbconn;
	protected $query;
	
	public function __construct($query, $dbconn) {
		if (!is_resource($dbconn)) {
			throw new FxS_Query_Error("Invalid connection");
		}
		
		$this->query = $query;
		$this->dbconn = $dbconn;
	}

	public function count_rows() {
		return mysql_num_rows($this->query);	
	}

	public function fetch_row() {
		return mysql_fetch_row($this->query);	
	}

	public function fetch_assoc() {
		return mysql_fetch_assoc($this->query);	
	}
	
	public function fetch_all() {
		$all = array();	
		while($row = $this->fetch_assoc()) {
			$all[] = $row;	
		}
		return $all;
	}
}
?>