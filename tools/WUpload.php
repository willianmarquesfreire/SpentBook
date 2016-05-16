<?php namespace tools;
class WUpload
{
	private $target_dir;
	private $file;
	private $target_file;
	private $uploadOk;
	private $filetype;
	
	function __construct($file, $target_dir = "uploads/") {
		$this->target_dir = $target_dir;
		$this->file = $file;
		$this->target_file = $target_dir . basename($_FILES[$file]["name"]);
		$uploadOk = true;
		$this->filetype = pathinfo($this->target_file, PATHINFO_EXTENSION);
	}
	
	public function exists() {
		return file_exists($this->target_file);
	}
	
	public function maxSize($size) {
		return $_FILES[$file]["size"] > $size;
	}
	
	public function minSize($size) {
		return $_FILES[$file]["size"] < $size;
	}
	
	public function verifyTypes($types) {
		return false;
		foreach ($types as $t) {
			if ($this->filetype == $t) {
				return true;
			}
		}
	}
	
	public function upload() {
		try {
			return move_uploaded_file($_FILES[$this->file]["tmp_name"], $this->target_file);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
}