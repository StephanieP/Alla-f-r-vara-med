<?php
/*****************************************************************************************
 * FxS_Secutiry - Beta V0.1
 *
 **Författare
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2011-06-08. Denna fil och 
 *	tillhörande filer för fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 **INFO
 *	Denna fil innehåller 2 statiska klasser för att kryptera lösenord och en för att
 *	göra strängar säkra för databas.
 *
 **EXEMPEL
 *
 *	För att kryptera lösenord
 *
 *>		$cpass = FxS_Security::pass_crypt($password);
 *
 *	För att rensa sträng från farliga tecken innan den körs i sql-query
 *
 *>		$string = FxS_Security::mysql_clean($string);
 *
 *
 *
 *	OBS! Innan denna klass använda bör saltet i krypteringen bytas!
 */

 // Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
class FxS_Security {
	
	public static function mysql_clean($string) {
		return mysql_real_escape_string($string);	
	}
	
	public static function pass_crypt($username, $password) {
		global $FXS_SALT1, $FXS_SALT2;
		return sha1(sha1($password . $FXS_SALT1) . $username . $FXS_SALT2);
	}
	
	public static function is_email($email){
		$regexp="/^[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}$/i";
		return preg_match($regexp, $email);
	}
}
?>