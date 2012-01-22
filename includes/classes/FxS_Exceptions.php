<?php
// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
class FxS_Username_Error extends Exception{};
class FxS_Password_Error extends Exception{};
class FxS_Activation_Error extends Exception{};
class FxS_Login_Locked_Error extends Exception{};
class FxS_Login_Not_Activated_Error extends Exception{};

class FxS_Missing_Argument_Error extends Exception{};
class FxS_Dublicate_Entery_Error extends Exception{};

class FxS_Validation_Length_Error extends Exception {};
class FxS_Validation_Char_Error extends Exception {};
class FxS_Validation_Error extends Exception {};

class FxS_Mysql_Error extends Exception {}
class FxS_Query_Error extends Exception {}

?>