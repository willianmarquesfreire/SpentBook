<?php namespace tools;
class WFile
{
	private $file;
	private $filename;
	private $content;
	private $mode;
	
	/* R -> Read; W -> Write; X -> New; _ -> Pointer*/
	const 	_R = "r",
			_W = "w",
			R_ = "a",
			_X_ = "x",
			_RW = "r+",
			_RWC = "w+",
			RW_ = "a+",
			_XRW_ = "x+";
	
	function __construct($file, $mode = SELF::_RW) {
		try {
			$this->filename = $file;
			$this->mode = $mode;
			$this->file = fopen($file, $mode);
			return $this->file;
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function setMode($mode) {
		try {
			$this->file = fopen($this->filename, $mode);
			return $this->file;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function read() {
		try {
			return fread($this->file, filesize($this->filename));
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function readLine() {
		try {
			return fgets($this->file);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function readChar() {
		try {
			return fgetc($this->file);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function isEnd() {
		return feof($this->file);
	}
	
	public function write($str) {
		try {
			return fwrite($this->file, $str);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function close() {
		try {
			fclose($this->file);
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function create($filename, $str = null) {
		try {
			$this->file = fopen($filename, self::_W);
			$this->filename = $filename;
			if ($str != null) $this->write($str);
			
			return $this->file;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
	public function erase() {
		try {
			fclose($this->file);
			$this->file = fopen($this->filename, self::_W);
			fwrite($this->file, null);
			$this->setMode(self::_RW);
			
			return $this->file;
		} catch (Exception $e) {
			return $e->getMessage();
		}
	}
	
}