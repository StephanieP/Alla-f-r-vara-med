<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
class FxS_Error {
	public static function report($error_string, $mysql) {
		$ip = FxS_Security::mysql_clean($_SERVER['REMOTE_ADDR']);
		$error_string = strlen($error_string) > 255 ? substr($error_string, 0, 255) : $error_string;
		$error_string = FxS_Security::mysql_clean($error_string);
		$mysql->execute("
			INSERT INTO fxs_error_log(error_date, 
									  error_string, 
									  error_ip)
								VALUE(UNIX_TIMESTAMP(),
									  '$error_string',
									  '$ip')
			ON DUPLICATE KEY 
				UPDATE error_count = error_count + 1;
									  
		");
	}
}

?>