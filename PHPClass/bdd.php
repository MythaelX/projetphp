<?php
	class Bdd{
		public $db;
		private $req;
		private $dbType;
		
		function __construct($type, $host, $name = "", $user = "", $pass = ""){
			$array = array(
				"mysql" => "MySQL",
				"sqlite" => "SQLite"
			);
			
			$this->dbType = "";
			
			if(isset($type) && strtolower($type) == strtolower($array["sqlite"])){
				$this->dbType = $array["sqlite"];
				
				try {
					$this->db = new PDO("sqlite:" . $host);
				} catch(PDOException $e){
					error_log($this->dbType . ' connect error: ' . $e->getMessage());
					die();
				}
			} else if(isset($type) && strtolower($type) == strtolower($array["mysql"])){
				$this->dbType = $array["mysql"];
				
				try {
					$this->db = new PDO("mysql:host=" . $host . ";dbname=" . $name . ";charset=UTF8", $user, $pass);
				} catch(PDOException $e){
					error_log($this->dbType . ' connect error: ' . $e->getMessage());
					die();
				}
			} else {
				$error_text = "BDD error: You have to choose a bdd type between ";
				
				foreach($array as $key => $val){
					$error_text .= strtolower($val) . " | ";
				}
				
				error_log($error_text);
				die();
			}
		}
	
		private function secureValues($val){
			$val = $this->db->quote($val);
		
			return $val;
		}
		
		public function select($name, $selection, $opt=""){
			try {
				if(!($this->req = $this->db->query("SELECT $selection FROM $name $opt"))){
					return "";
				} else {
					$datas = $this->req->fetchAll(PDO::FETCH_ASSOC);
					$this->req->closeCursor();
				}
			
				if($datas === false){
					return "";
				} else {
					return $datas;
				}
			} catch(PDOException $e){
				error_log($this->dbType . ' select request error: ' . $e->getMessage());
				return false;
			}
		}
		
		public function selectJson($name, $selection, $opt=""){
			try {
				if(!($this->req = $this->db->query("SELECT $selection FROM $name $opt"))){
					return "";
				} else {
					$datas = $this->req->fetchAll(PDO::FETCH_ASSOC);
					$this->req->closeCursor();
				}
			
				if($datas === false){
					return "";
				} else {
					return json_encode($datas);
				}
			} catch(PDOException $e){
				error_log($this->dbType . ' select request error: ' . $e->getMessage());
				return false;
			}
		}
	
		public function insert($name, $val){
			try {
				$this->db->exec("INSERT INTO $name VALUES(" . $this->secureValues($val) . ")");
			} catch(PDOException $e){
				error_log($this->dbType . ' insert request error: ' . $e->getMessage());
				return false;
			}
		}
	
		public function update($name, $val){
			$vals = explode(" = ", $val);
				for($i = 1; $i < sizeOf($vals); $i += 2){
					$vals[$i] = $this->secureValues($vals[$i]);
				}
			$val = implode(" = ", $vals);
		
			try {
				$this->db->exec("UPDATE $name SET $val");
			} catch(PDOException $e){
				error_log($this->dbType . ' update request error: ' . $e->getMessage());
				return false;
			}
		}
	
		public function delete($name, $where){
			try {
				$this->db->exec("DELETE $name WHERE $where");
			} catch(PDOException $e){
				error_log($this->dbType . ' delete request error: ' . $e->getMessage());
				return false;
			}
		}
	}

	/*function dbConnect($host, $name, $user, $pass){
		try {
			return (new PDO("mysql:host=" . $host . ";dbname=" . $name . ";charset=UTF8", $user, $pass));
		} catch(PDOException $e){
			error_log('MySQL connect error: ' . $e->getMessage());
			return false;
		}
	}
	function sqliteConnect($file){
		try {
			return (new PDO("sqlite:" . $file));
		} catch(PDOException $e){
			error_log('SQLite connect error: ' . $e->getMessage());
			return false;
		}
	}*/
	
	/*function dbSelect($db, $name, $selection, $opt=""){
		try {
			if(!($req = $db->query("SELECT $selection FROM $name $opt"))){
				return "";
			} else {
				$datas = $req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
			}
			
			if($datas === false){
				return "";
			} else {
				return $datas;
			}
		} catch(PDOException $e){
			error_log('Request error: ' . $e->getMessage());
			return false;
		}
	}
	
	function dbSelectJson($db, $name, $selection, $opt=""){
		try {
			if(!($req = $db->query("SELECT $selection FROM $name $opt"))){
				return "";
			} else {
				$datas = $req->fetchAll(PDO::FETCH_ASSOC);
				$req->closeCursor();
			}
			
			if($datas === false){
				return "";
			} else {
				return json_encode($datas);
			}
		} catch(PDOException $e){
			error_log('Request error: ' . $e->getMessage());
			return false;
		}
	}
	
	function dbSecureValues($db, $val){
		$val = $db->quote($val);
		
		return $val;
	}
	
	function dbInsert($db, $name, $val){
		try {
			$db->exec("INSERT INTO $name VALUES(" . dbSecureValues($db, $val) . ")");
		} catch(PDOException $e){
			error_log('Request error: ' . $e->getMessage());
			return false;
		}
	}
	
	function dbUpdate($db, $name, $val){
		$vals = explode(" = ", $val);
			for($i = 1; $i < sizeOf($vals); $i += 2){
				$vals[$i] = dbSecureValues($db, $vals[$i]);
			}
		$val = implode(" = ", $vals);
		
		try {
			$db->exec("UPDATE $name SET $val");
		} catch(PDOException $e){
			error_log('Request error: ' . $e->getMessage());
			return false;
		}
	}
	
	function dbDelete($db, $name, $where){
		try {
			$db->exec("DELETE $name WHERE $where");
		} catch(PDOException $e){
			error_log('Request error: ' . $e->getMessage());
			return false;
		}
	}*/
?>
