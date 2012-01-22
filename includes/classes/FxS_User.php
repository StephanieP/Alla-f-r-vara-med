<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}

/*****************************************************************************************
 * FxS_User - Beta V0.1
 *
 **Författare
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2011-06-08. Denna fil och 
 *	tillhörande filer får fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 *	Tillhörande filer (och klasser som krävs för att denna klass ska fungera):
 *		FxS_String_Validation.php 	(Class: FxS_String_Validation)
 *		FxS_Mysql.php 	 			(Class: FxS_Mysql, FxS_Query)
 *		FxS_Security.php 			(Class: FxS_Mysql, FxS_Query)
 *
 *
 **INFO
 *	Detta är en fil som innehåller en PHP-klass för att hantera medlemmar i ett webbsystem.
 *	Klassen bygger på objektorienterad PHP för att så enkelt som möjligt kunna hantera 
 *	användaren utan att använda fler än ett par rader kod.
 *
 *
 **ANVÄNDNING
 *	Skapa en global variabel med objektet "User" så här: $USER = new User;
 *	Gör detta högst upp i alla dina filer eller i en fil som inkluderas
 *	högst upp i alla dina filer. Därefter används enbart $USER för att 
 *	hantera användarna.
 *
 *
 **FUNKTIONER
 *	__construct($mysql)				- Tar databasanslutning som argument.
 *
 *	login(string $username,			- Logga in användare
 *		  string $password)	 		OBS! Lösenordet ska skickas okrypterat.
 *							  		
 *
 *	logout()						- Loggar ut användaren och nollställer sessioner
 *
 *	is_logon()						- Kontrollerar om användaren är inloggad i systemet.
 *
 *	is_privileged(string $priv)		- Kontrollerar om användaren har ett visst privilegie
 *							  		Text, $USER->is_privileged('admin'); retunerar sant
 *							 		om användaren har privilegiet admin.
 *
 *	register(string $username,		- Registrerar användaren om inte användarnamnet är upptaget
 *			 string $password) 		OBS! Lösenordet krypteras av funktionen, okrypterat 
 *							  		lösenord ska skickas som argument.
 * 
 *
 **PUBLIKA VAIABLER (OBS! BÖR EJ ÄNDRAS UTIFRÅN, ENBART LÄSAS AV)
 *	$login_id		- Användarens ID.
 *	$login_time		- Tid i unix-time då användaren loggad in.
 *	$login_ip		- Användarens ip-adress.
 *
 *
 **EXCEPTIONS
 *	Inloggning
 *		FxS_Login_Error 				- Om användarnamn eller lösenord är fel
 *		FxS_Login_Locked_Error			- Om användaren är låst
 *		FxS_Login_Not_Activated_Error - Kontot inte aktiverat
 *
 * 	Registrering
 *		FxS_Missing_Argument_Error - Lösenord eller användarnamn saknas
 *		FxS_Dublicate_Entery_Error - Användarnamnet är upptaget
 *			FxS_Validation_Char_Error   - (Class: String_Validation) om användarnamn innehåller ogilltiga tecken 
 *			FxS_Validation_Length_Error - (Class: String_Validation) om lösenord eller användarnamn är kortare än 
 *									  4 tecken eller användarnamn är längre än 20 tecken.
 *
 *
 **EXEMPEL
 *	Variabel
 *		Skapa först global variabel högst upp i alla filer eller i fil som inkluderas
 *		högst upp i alla filer som ska använda sig av information från en användare.
 *
 *>			$USER = new User;
 *	
 *	
 *	Registrera användare
 *		Detta görs förslagsvis i filen register.php eller liknande. Vi antar att vi har
 *		två postade variabler från HTML, $_POST['username'] och $_POST['password'].
 *
 *>			$USER->username = $_POST['username'];
 *>			$USER->register($_POST['password']);
 *
 *		Funktionen tar hand om sanering av input-data så vi behöver inte oroa oss för 
 *		SQL-injections (hackare). Observera att detta kan resultera i att vi får 
 *		Exceptions. Om tillexempel användarnamnet finns. Dessa måste vi fånga:
 *
 *>			try {
 *>				$USER->register($_POST['username'], $_POST['password']);
 *>			}
 *>			catch (Missing_Argument_Error $e) {
 *>				//Användarnamn eller lösenord är inte satt
 *>			}
 *>			catch (Dublicate_Entery_Error $e) {
 *>				//Användarnamnet är upptaget
 *>			}
 *>			catch (Validation_Char_Error $e) {
 *>				//Ogilltiga tecken i användarnamnet
 *>			}
 *>			catch (Validation_Length_Error $e) {
 *>				// Lösenord eller användarnamn är kortare än 4 tecken eller
 *>				// användarnamn är längre än 20 tecken.
 *>			}
 *
 *
 * 
 *	Logga in användare
 *		Det räcker med att logga in användaren en gång. Sen är användaren inloggad ända 
 *		tills användaren loggar ut eller stänger webbläsaren.
 *
 *>			$USER->username = "Användarnamn";
 *>			$USER->login("lösenord");
 *
 *		Även här sköter funktionen sanering av data så det är lugnt att skicka in 
 *		$_POST-variabler direkt som argument. Även denna funktion kan slänga exceptions
 *		om något blir fel (Se lista ovan). Gör därför på samma sätt som vid registrering 
 *		med catch. Inloggningen börjar gälla direkt. Man kan direkt efter dessa två rader
 *		kontrollera om användaren är inloggad och skicka vidare till annan sida.
 *
 *
 *
 *	Se om användare är inloggad
 *		Detta görs via funktionen is_logon(). is_logon() är sant (TRUE) om användaren är 
 *		inloggad, annars falsk (FALSE).
 *
 *>			if ($USER->is_logon()) {
 *>				//Användaren är inloggad
 *>			}
 *
 *	
 *
 *	Kontrollera privilegie
 *		Man sätter privilegier på användaren för att låta vissa användare få mer tillgång
 *		andra. Låt oss säga att vi har privilegier "admin" knutet till några av våra 
 *		användare i databasen. Vi ska nu kontrollera om besökaren är en av dem.
 *
 *>			if ($USER->is_privileged('admin')) {
 *>				//Användaren har privilegiet admin
 *>			}
 *
 *		Om användaren inte är inloggad retunerar is_privileged alltid falskt (FALSE).
 *
 *
 *
 * 	Logga ut användare
 *		Funktionen logout() loggar ut användare, utloggningen gäller direkt efter anrop och 
 *		ända tills användaren loggar in igen.
 *
 *>			$USER->logout();
 *
 *
 ******************************************************************************************/

class FxS_User {
	public $username;
	public $login_id;
	public $login_time;
	public $login_ip;
	public $last_ip;
	public $last_login;
	public $unreaded_guestbook;
	public $avatar_name;
	private $activated;
	private $privileges;
	private $mysql;

	public function __construct($mysql) {
		$this->mysql = $mysql;
		if ($this->is_logon()) {
			$this->username    = $_SESSION['FxS_login']['username'];
			$this->login_id    = $_SESSION['FxS_login']['id'];
			$this->login_time  = $_SESSION['FxS_login']['time'];
			$this->login_ip	   = $_SESSION['FxS_login']['ip'];
			$this->last_ip	   = $_SESSION['FxS_login']['last_ip'];
			$this->activated   = $_SESSION['FxS_login']['activated'];
			$this->last_login  = $_SESSION['FxS_login']['last_login'];
		}
	}

	public function login($username, $password) {
		$stmt = $this->mysql->execute(
			"SELECT * 
			FROM fxs_login_accounts 
			WHERE login_username = '".FxS_Security::mysql_clean($username)."'"
		);
		$user = $stmt->fetch_assoc();
		if (!$user) {
			throw new FxS_Username_Error;
		}
		if ($user["login_password"] !== 
		  FxS_Security::pass_crypt($username, $password)) {
			throw new FxS_Password_Error;
		}
		if ($user["login_locked"] != 0) {
			throw new FxS_Login_Locked_Error;
		}		
		$this->login_id   = $user['login_ID'];
		$this->username   = $user['login_username'];
		$this->last_ip    = $user['last_login_ip'];
		$this->activated  = $user['login_activated'];
		$this->last_login = $user['last_login'];
		$this->login_ip   = $_SERVER['REMOTE_ADDR'];
		$this->login_time = time();
		$this->set_privileges();
		$this->set_session();
		$this->mysql->execute(
			"UPDATE fxs_login_accounts 
			SET last_login    = UNIX_TIMESTAMP(), 
				last_login_ip = '{$_SERVER['REMOTE_ADDR']}'
			WHERE login_ID = '" . intval($this->login_id) . "' 
			LIMIT 1"
		);
	}

	
	public function logout() {
		$_SESSION['FxS_login']['privileges']['user_login'] = FALSE;
		session_unset();
		session_destroy();
		unset($this->username, 
			  $this->login_id, 
			  $this->login_time, 
			  $this->login_ip,
			  $this->activated,
			  $this->last_ip);
	}

	public function register($username, $password, $req_activation = false) {
		if(!isset($username, $password)) {
			throw new FxS_Missing_Argument_Error;	
		}
		$username = trim($username);
		$strval = new FxS_String_Validation;
		$strval->min_length = 4;
		try {
			$strval->validate($password);
		}
		catch (FxS_Validation_Length_Error $e) {
			throw new FxS_Password_Error;
		}
		
		$strval->max_length = 20;
		$strval->regex      = "/^[a-z0-9_åäöÅÄÖ]+$/i";
		try {
			$strval->validate($username);
		}
		catch (FxS_Validation_Length_Error $e) {
			throw new FxS_Username_Error;
		}
		
		$query = $this->mysql->execute(
			"SELECT * 
			FROM fxs_login_accounts 
			WHERE login_username = '".FxS_Security::mysql_clean($username)."'"
		);
		$user = $query->fetch_assoc();
		if($user) {
			throw new FxS_Dublicate_Entery_Error;
		}
		
		$activated = $req_activation ? 0 : 1;

		$pass_hash = FxS_Security::pass_crypt($username, $password);
		$query = $this->mysql->execute(
			"INSERT INTO `fxs_login_accounts` (
				`login_username` ,
				`login_password` ,
				`register_date` ,
				`register_ip` ,
				`login_activated`)
			VALUE (
				'$username', 
				'$pass_hash', 
				UNIX_TIMESTAMP(),
				'{$_SERVER['REMOTE_ADDR']}', 
				'$activated')"
		);
		$this->login($username, $password);	
	}

	public function change_password($current_pass, $new_pass) {
		$strval = new FxS_String_Validation;
		$strval->min_length = 4;
		$strval->validate($new_pass);
		$stmt = $this->mysql->execute(
			"SELECT login_password 
			FROM fxs_login_accounts
			WHERE login_ID = '" . intval($this->login_id) . "'"
		);
		$user = $stmt->fetch_assoc();
		if ($user["login_password"] !== 
				FxS_Security::pass_crypt($this->username, $current_pass)) {
			throw new FxS_Password_Error;
		}
		$pass_crypt = FxS_Security::pass_crypt($this->username, $new_pass);
		$this->mysql->execute(
			"UPDATE fxs_login_accounts
			SET login_password = '$pass_crypt' 
			WHERE login_ID = '" . intval($this->login_id) . "' 
			LIMIT 1"
		);
	}
	
	public function get_activation_code() {
		global $FXS_SALT1;
		return substr(md5($this->username . $FXS_SALT1), 0, 10);
	}
	
	public function activate($validation_code) {
		if ($validation_code != $this->get_activation_code()) {
			throw new FxS_Password_Error;
		}
		$this->mysql->execute(
			"UPDATE fxs_login_accounts
			SET login_activated = '1' 
			WHERE login_ID = '" . intval($this->login_id) . "' 
			LIMIT 1"
		);
	}
	
	public function is_logon() {
		return isset($_SESSION['FxS_login']['id']);
	}
	
	public function is_privileged($privilege) {
		return ($this->is_logon() && 
				isset($_SESSION['FxS_login']['privileges'][$privilege]) && 
				$_SESSION['FxS_login']['privileges'][$privilege] === TRUE);	
	}
	
	public function is_activated() {
		return ($this->activated == 1);
	}
	
	private function set_privileges() {
		$_SESSION['FxS_login']['privileges']['user_login'] = TRUE;
		$stmt = $this->mysql->execute(
			"SELECT privilege_value 
				AS value
			FROM fxs_login_privileges 
			WHERE login_id = '" . intval($this->login_id) . "'"
		);
		while($priv = $stmt->fetch_assoc()) {
			$_SESSION['FxS_login']['privileges'][$priv['value']] = TRUE;
		}
	}
	
	private function set_session() {
		$_SESSION['FxS_login']['username'] = $this->username;
		$_SESSION['FxS_login']['id']       = $this->login_id;
		$_SESSION['FxS_login']['time']     = $this->login_time;
		$_SESSION['FxS_login']['ip']       = $this->login_ip;
		$_SESSION['FxS_login']['last_ip']  = $this->last_ip;
		$_SESSION['FxS_login']['activated']= $this->activated;
		$_SESSION['FxS_login']['unreaded_guestbook'] = $this->unreaded_guestbook;
		$_SESSION['FxS_login']['last_login'] 	     = $this->last_login;
	}
}


?>