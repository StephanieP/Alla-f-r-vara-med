<?php
/************************************************************************************
 * FxS_String - BETA V0.1
 *
 **Författare
 *	Denna fil är skapad av Felix Stridsberg, Linköping, 2011-06-08. Denna fil och 
 *	får fritt användas för privat bruk.
 *	Utförliga guider för användning finns på: http://webbprogrammering.ifokus.se
 *
 *
 **INFO
 *	Denna PHP-klass föreklar valideringen av strängar. Stängar valideras med minsta 
 *	längd, största läng samt regex.
 *
 *
 **FUNKTIONER
 *	validate()	- Skickar exceptions om strängen inte uppfyller kraven.
 *
 *
 **EXCEPTIONS
 *	validering 
 *		Validation_Length_Error		- Längden är fel
 *		Validation_Char_Error		- Strängen stämmer inte med regex
 *
 *
 **PUBLIKA VARIABLER
 *	$max_length		- Det största antalet tecken i stängen. 	Standard: 256
 *	$min_length		- Det lägsta antalet tecken i stängen.		Standard: 0
 *	$regex			- För validering med regex.					Standard: NULL
 *	$encoding		- Teckenkodning för att räkna tecken rätt.	Standard: UTF8
 *
 *
 **EXEMPEL
 *	Validera längd på stäng
 *>		$username = $_POST['username'];
 *>		$strval = new String_Validation;
 *>		$strval->$max_length = 20;
 *>		$strval->$min_length = 5;
 *>		try {
 *>			$strval->validate();
 *>		}
 *>		catch(Validation_Length_Error $e) {
 *>			//Fel läng på strängen 
 *>		}
 *
 *
 *	Validera längd och regex på stäng
 *>		$username = $_POST['username'];
 *>		$strval = new String_Validation;
 *>		$strval->$max_length = 20;
 *>		$strval->$min_length = 5;
 *>		$strval->regex       = "/^[a-z0-9_åäöÅÄÖ]+$/i";
 *>		try {
 *>			$strval->validate();
 *>		}
 *>		catch(Validation_Length_Error $e) {
 *>			//Fel läng på strängen 
 *>		}
 *>		catch(Validation_Char_Error $e) {
 *>			//Felaktiga tecken i strängen 
 *>		}
 **************************************************************************************/
 // Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
class FxS_String_Validation {
	public $max_length;
	public $min_length;
	public $regex;
	public $encoding;
	
	public function __construct() {
		$this->max_length = 256;
		$this->min_length = 0;
		$this->encoding = 'UTF8';
	}
	
	public function validate($string) {
		if(mb_strlen($string, $this->encoding) < $this->min_length || 
		   mb_strlen($string, $this->encoding) > $this->max_length) {
			throw new FxS_Validation_Length_Error(
				"The string length doesn't match validator"
			);
		}
		if (isset($this->regex) && !preg_match($this->regex, $string)) {
			throw new FxS_Validation_Char_Error(
				"The string contains not valid chars"
			);
		}
	}
}

class FxS_Text {
	public $bbcode;
	public $htmlentites;
	public function __construct($bbcode = TRUE, $nl2br = TRUE, $htmlentities = TRUE) {
		$this->bbcode = $bbcode;
		$this->nl2br = $nl2br;
		$this->htmlentities = $htmlentities;
	}
	public function format($text, $encode = 'UTF-8') {
		if ($this->htmlentities)
			$text = htmlentities($text, ENT_QUOTES, $encode);
		if ($this->nl2br)
			$text = nl2br($text);
		if ($this->bbcode)
			$text = $this->bbcode($text);
		
		return $text;
	}
	public function bbcode($text) {
		$text = preg_replace ('/\[b\](.*?)\[\/b\]/is', '<strong>$1</strong>', $text);
		$text = preg_replace ('/\[i\](.*?)\[\/i\]/is', '<em>$1</em>', $text);
		$text = preg_replace ('/\[link\=(.*?)\](.*?)\[\/link\]/is', '<a href="$1">$2</a>', $text);
		$text = preg_replace ('/\[img\](.*?)\[\/img\]/is', '<img style="max-width: 100%;" src="$1" />', $text);
		$text = preg_replace ('/\[size=([1-5])\](.*?)\[\/size\]/is', '<font size="$1">$2</font>', $text);
		$smilies = array(
			 "[smile]",
			 "[sad]",
			 "[chocked]",
			 "[wink]",
			 "[bored]"
		);
		
		$smilies_replace = array(
			 "<img class=\"smiley\" src=\"/graphics/ui/site/symbols/smile.png\" alt=\"[smile]\">",
			 "<img class=\"smiley\" src=\"/graphics/ui/site/symbols/sad.png\" alt=\"[sad]\">",
			 "<img class=\"smiley\" src=\"/graphics/ui/site/symbols/chocked.png\" alt=\"[chocked]\">",
			 "<img class=\"smiley\" src=\"/graphics/ui/site/symbols/wink.png\" alt=\"[wink]\">",
			 "<img class=\"smiley\" src=\"/graphics/ui/site/symbols/bored.png\" alt=\"[bored]\">"
		);
		
		$text = str_ireplace($smilies,$smilies_replace,$text); 
		return $text;	
	}
}
?>