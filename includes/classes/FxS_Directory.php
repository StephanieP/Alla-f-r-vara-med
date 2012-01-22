<?php
// Kan enbart k�ras som FxS_core.php �r inkluderad f�re.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
class FxS_Directory {
	
	public static function fxs_hierarchy_sys($hier_root_path, $file_name) {
		$folder = substr($file_name, 0, 2);
		if (!file_exists($hier_root_path . $folder)) {
			mkdir($hier_root_path . $folder);	
		}
		return $hier_root_path . $folder . "/";
	}
	
	public static function fxs_hierarchy_html($hier_root_path, $file_name) {
		$folder = substr($file_name, 0, 2);
		return $hier_root_path . $folder . "/";
	}
}

?>