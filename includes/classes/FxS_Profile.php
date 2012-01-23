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
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2012-01-23. Denna fil och 
 *	tillhörande filer får fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 *	Tillhörande filer (och klasser som krävs för att denna klass ska fungera):
 *		FxS_Mysql.php 	 			(Class: FxS_Mysql, FxS_Query)
 *			- Globala variabeln $MYSQL måste existera
 *
 *
 **INFO
 *	Denna fil används för att hantera använadres profilsidor. Skriva läsa och ändra dessa.
 *
 *
 **FUNKTIONER
 *
 *	__construct($user_id, $fields);		- Heltal x Sträng ->
 *										  $user_id är användaren som vi ska hanteras login_ID
 *										  $fields är en sträng med fält som ska hämtas från 
 *										  databasen, det går att hämta fält från tabellen 
 *										  fxs_login_accounts med prefixet "l." och från 
 *										  fxs_profile med prefixet "p.". Som standard hämtas 
 *										  alla fält, rekommenderas ej! - Se databasstruktur för
 *										  vilka fält som finns.
 *
 *	get_email()							- -> Sträng/null
 *										  Retunerar användarens email. Retunerar null om fältet 
 *										  inte är hämtat från databasen eller om fältet är tomt.
 *
 *	get_profile_text()					- -> Sträng/null
 *										  Retunerar användarens profil text. Retunerar null om fältet 
 *										  inte är hämtat från databasen eller om fältet är tomt.
 *
 *	get_username()						- -> Sträng/null
 *										  Retunerar användarens användarnamn. Retunerar null om fältet 
 *										  inte är hämtat från databasen eller om fältet är tomt.
 *
 *	get_last_login()					- -> Sträng/null
 *										  Retunerar senast inloggning i UNIX-time. Retunerar null om fältet 
 *										  inte är hämtat från databasen eller om fältet är tomt.
 *
 **ANVÄNDNING
 *
 *
 *****************************************************************************************/
class FxS_Profile {
	
	private $profile_info;
	private $login_id;
	
	public function __construct($login_id, $fields = "p.*,l.*") {
		global $MYSQL;
		
		$login_id = intval($login_id);
		$this->login_id = $login_id;
		$fields = FxS_Security::mysql_clean($fields);
		
		$this->profile_info = $MYSQL->execute("
			SELECT $fields
				FROM fxs_profile AS p
			LEFT JOIN fxs_login_accounts AS l 
				ON (l.login_ID = $login_id)
			WHERE p.login_id = '$login_id'
			LIMIT 1
		")->fetch_assoc();

		if(!$this->profile_info) {
			$this->create_profile();	
		}
	}

	
	public function get_email() {
		if (is_array($this->profile_info) && !empty($this->profile_info['profile_email'])) {
			return $this->profile_info['profile_email'];
		}
		else {
			return null;
		}
	}
	
	public function get_profile_text() {
		if (is_array($this->profile_info) && !empty($this->profile_info['profile_text'])) {
			return $this->profile_info['profile_text'];
		}
		else {
			return null;
		}
	}
	
	public function get_username() {
		if (is_array($this->profile_info) && !empty($this->profile_info['login_username'])) {
			return $this->profile_info['login_username'];
		}
		else {
			return null;
		}
	}
	
	public function get_last_login() {
		if (is_array($this->profile_info) && !empty($this->profile_info['last_login'])) {
			return $this->profile_info['last_login'];
		}
		else {
			return null;
		}
	}
	
	public function set_profile_text($text) {
		global $MYSQL;
		$text = FxS_Security::mysql_clean($text);
		
		$MYSQL->execute("
			UPDATE fxs_profile
				SET profile_text = '$text'
			WHERE login_id = '" . $this->login_id . "'
			LIMIT 1
		");
	}
	
	private function create_profile() {
		global $MYSQL;
		
		//Kontollera om inloggning finns
		$login = $MYSQL->execute("
			SELECT login_ID 
				FROM fxs_login_accounts
			WHERE login_ID = '" . $this->login_id . "'
			LIMIT 1						 
		")->fetch_assoc();
		
		if ($login) {
			$MYSQL->execute("
				INSERT INTO fxs_profile(login_id) 
					VALUE('" . $this->login_id . "')
			");
		}
	}
	
}

?>