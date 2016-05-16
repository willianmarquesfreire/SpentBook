<?php namespace App\Models;


class Model
{
	protected $table = "";
	protected $fields = [];
	
	public function insert($values) {
		return $_SESSION["conn"]::insert($this->table, $this->fields, $values);
	}
	
	public function update($set, $where) {
		return $_SESSION["conn"]::update($this->table, $set, $where);
	}
	
	public function delete($sql) {
		return $_SESSION["conn"]::delete($this->table, $sql);
	}
	
	public function listAll() {
		return $_SESSION["conn"]::select($this->table, $_SESSION["conn"]::W_ALL)->fetchAll();
	}
	
	public function listItem() {
		return $_SESSION["conn"]::select($this->table, $_SESSION::W_ALL, null, 1);
	}
}