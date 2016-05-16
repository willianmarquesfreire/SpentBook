<?php

class WBaseManager
{
	static private $server;
	static private $user;
	static private $pass;
	static private $db;
	static private $dbname;
	static private $conn;
	static private $errorMsg;
	static private $sql;
	
	const W_ALL = "*";

	public static function start($connect = true) {
		include __DIR__."/../database/config.php";
		self::$server = $config["connections"][$config["default"]]["host"];
		self::$user = $config["connections"][$config["default"]]["username"];
		self::$pass = $config["connections"][$config["default"]]["password"];
		self::$db = $config["connections"][$config["default"]]["driver"];
		self::$dbname = $config["connections"][$config["default"]]["database"];
	
		if ($connect) {
			self::connect();
		}
	}
	
	public static function getServer() {
		return self::$server;
	}
	
	public static function setServer($server) {
		self::$server = $server;
	}
	
	public static function getUser() {
		return self::$user;
	}
	
	public static function setUser($user) {
		self::$user = $user;
	}
	
	public static function getPass() {
		return self::$pass;
	}
	
	public static function setPass($pass) {
		self::$pass = $pass;
	}
	
	public static function getDB() {
		return self::$db;
	}
	
	public static function setDB($db) {
		self::$db = $db;
	}
	
	public static function getDBName() {
		return self::$dbname;
	}
	
	public static function setDBName($dbname) {
		self::$dbname = $dbname;
	}
	
	public static function getConn() {
		return self::$conn;
	}
	
	public static function setConn($conn) {
		self::$conn = $conn;
	}
	
	public static function getErrorMsg() {
		return self::$errorMsg;
	}
	
	public static function setErrorMsg($errorMsg) {
		self::$errorMsg = $errorMsg;
	}
	
	public static function connect() {
		try {
			self::$conn = new PDO(self::$db.":host=".self::$server.";dbname=".self::$dbname, self::$user, self::$pass, [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'']);
			self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return true;
		} catch (PDOException $e) {
			self::$errorMSG = $e->getMessage();
			return false;
		}
	}
	
	public static function terminate() {
		self::$conn = null;
	}
	
	public static function insert($table, $field, $value) {
		
		self::$sql = "insert into $table(";
			
		foreach ($field as $v) {
			self::$sql .= $v . ',';
		}
		
		self::$sql = substr(self::$sql, 0, -1);
		self::$sql .= ") values(";
			
		foreach ($value as $v) {
			self::$sql .= $v . ',';
		}
			
		self::$sql = substr(self::$sql, 0, -1);
		self::$sql .= ");";
		
		echo self::$sql;
		
		self::execSQL(self::$sql);
	}
	
	public static function multiInsert($table, $field, $value) {
		
		try {
			self::$conn->beginTransaction();
			
			$sqlInsert = "";
			$sqlAux = "";
			
			$sqlInsert = "insert into $table(";
				
			foreach ($field as $v) {
				$sqlInsert .= $v . ',';
			}
			
			$sqlInsert = substr($sqlInsert, 0, -1) . ") values(";
			
			for ($i = 0, $ix = count($value); $i < $ix; $i++) {
	
				for ($j = 0, $jx = count($field); $j < $jx; $j++) {
					$sqlAux .= $value[$i][$j] . ",";
				}
				
				self::$sql = $sqlInsert . substr($sqlAux, 0, -1) . ");"; 
				self::$conn->exec(self::$sql);
				$sqlAux = "";
			}
			
			return $this->conn->commit() ? $this->conn->lastInsertId() : false;
		} catch (PDOException $e) {
			echo $e->getMessage();
			return false;
		}
	}		
	
	
	public static function delete($table, $sql) {
		$this->sql = "DELETE FROM $table WHERE $sql";
		return $this->execSQL($this->sql) ? $this->sql : false;
	}
	
	public static function select($table, $select, $where = null, $limit = null) {
		
		$w = $where === null ?"" : " WHERE $where";
		$l = ($limit == null ? "" : " LIMIT $limit");
		self::$sql = "SELECT $select FROM $table " . $w . $l;
		
		$stmt = self::$conn->prepare(self::$sql);
		$stmt->execute();
		
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
		return $stmt;
	}
	
	public static function update($table, $set, $where) {
		self::$sql = "UPDATE $table SET $set WHERE $where";
		return self::execSQL(self::$sql);//TODO
	}
	
	public static function createDB($name) {
			$sql = "CREATE DATABASE $name";
			return self::execSQL($sql) ? self::$sql : false;
	}
	
	public static function dropDB($name) {
			$sql = "DROP DATABASE $name";
			return self::execSQL($sql) ? self::$sql : false;
	}
	
	public static function createTable($name, $items) {
			self::$sql = "CREATE TABLE $name (";
		
			foreach ($items as $value) {
				self::$sql .= $value . ',';
			}
			
			self::$sql = substr(self::$sql, 0, -1);
			
			self::$sql .= ")";
			
			return self::$execSQL(self::$sql) ? self::$sql : false;
	}
	
	public static function execSQL($sql) {
		try {

			self::getConn()->exec($sql);
			return $sql;
		} catch (PDOException $e) {
			self::$errorMsg = $e->getMessage();
			return false;
		}
	}
	
	public static function commit() {
		try {
			self::$conn->commit();
			return true;
		} catch (PDOException $e) {
			self::$errorMsg = $e->getMessage();
			return false;
		}
	}
	
	public function __toString() {
		if (self::$conn != null) {
			return "Connection Sucessfully!";
		} else {
			return "Connection Error!";
		}
	}
}







/*
 class TableRows
 {
 function __construct($it, $cols) {

 $this->beginIteration($cols);

 for ($i = 0, $c = count($it); $i < $c; $i++) {
 $this->beginChildren($i, $i);
 foreach ($it[$i] as $k=>$v) {
 $this->current($v, $v);
 }
 $this->endChildren();
 }

 $this->endIteration();


 }

 function beginIteration($cols) {
 echo "<div class='dbDivTable'><table class='dbTable'>";

 echo "<tr class='dbRowHead'>";

 foreach ($cols as $v) {
 echo "<th class='dbHead'>$v</th>";
 }
 echo "</tr>";
 }

 function current($elem, $id) {
 echo "<td class='dbData' id='$id'>" . $elem . "</td>";
 }


 function beginChildren($id) {
 echo "<tr class='dbRow' id='$id'>";
 }

 function endChildren() {
 echo "</tr>";
 }

 function endIteration() {
 echo "</table></div>";
 }


 }

 */






