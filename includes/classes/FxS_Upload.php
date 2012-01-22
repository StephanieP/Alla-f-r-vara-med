<?php

// Kan enbart köras som FxS_core.php är inkluderad före.
if (!defined("_EXECUTE")) {
	echo "Not allowed";
	exit;
}
	
class FxS_Upload {
	public $dest_dir;
	public $dest_name;
	public $file_types;
	public $file;
	public $file_max_size;
	private $validated;
	public function __construct($file = array(),
								$dest_file = NULL, 
								$file_max_size = 5000000,
								$file_types = array()) {
		$this->file = $file;
		$this->dest_file = $dest_file;
		$this->validated = false;
		$this->file_max_size = $file_max_size;
		$this->file_types = $file_types;
	}
	
	public function validate() {
		$this->validated = true;
		if ($this->file['error'] != 0) {
			throw new FxS_Upload_Image_Error($this->file['error']);
		}
		if (!in_array($this->file['type'], $this->file_types)) {
			throw new FxS_Upload_File_Error("Fel filformat");
		}
		if ($this->file['size'] > $this->file_max_size) {
			throw new FxS_Upload_Size_Error("För stor fil");
		}
	}
	
	public function execute_fh($file_handler) {
		if (!$this->validated) {
			$this->validate();	
		}
		$file_handler->sync($this->dest_file, $this->file['tmp_name']);
		$file_handler->execute();
	}
	
	public function upload() {
		if (!$this->validated) {
			$this->validate();	
		}
		
		if(!copy($this->file['tmp_name'], $this->dest_file)) {
			echo "Fock";	
		}
	}
}


class FxS_Upload_Image_Error extends Exception{};
class FxS_Upload_Size_Error extends Exception{};
class FxS_Upload_File_Error extends Exception{};
?>