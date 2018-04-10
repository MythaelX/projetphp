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
				
				$hosts = explode(":", $host);
				$host = $hosts[0];
				$port = $hosts[1];
				
				try {
					$command = "mysql:host=" . $host . ";port=" . $port . ";dbname=" . $name . ";charset=UTF8;";
					$this->db = new PDO($command, $user, $pass);
					
					if(isset($GLOBALS["DEBUG"]) && $GLOBALS["DEBUG"] == true){ echo $command . "<br />\n"; }
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
			//if(isset($GLOBALS["DEBUG"]) && $GLOBALS["DEBUG"] == true){ echo $val . "<br />\n"; }
			
			$val = explode("'", $val);
			$val = implode("\"", $val);
			
			//if(isset($GLOBALS["DEBUG"]) && $GLOBALS["DEBUG"] == true){ echo $val . "<br />\n"; }
		
			return $val;
		}
		
		public function select($name, $selection, $opt=""){
			try {
				$command = "SELECT $selection FROM $name $opt";
				if(!($this->req = $this->db->query($command))){
					return "";
				} else {
					$datas = $this->req->fetchAll(PDO::FETCH_ASSOC);
					$this->req->closeCursor();
				}
				
				if(isset($GLOBALS["DEBUG"]) && $GLOBALS["DEBUG"] == true){ echo $command . "<br />\n"; }
			
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
				$data = $this->select($name, $selection, $opt);
				
				if($data !== ""){
					return json_encode($data);
				} else {
					return "";
				}
			} catch(PDOException $e){
				error_log($this->dbType . ' select request error: ' . $e->getMessage());
				return false;
			}
		}
	
		public function insert($name, $val){
			try {
				$command = "INSERT INTO $name VALUES(" . $this->secureValues($val) . ")";
				$this->db->exec($command);
				if(isset($GLOBALS["DEBUG"]) && $GLOBALS["DEBUG"] == true){ echo $command . "<br />\n"; }
				return true;
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
				$command = "UPDATE $name SET $val";
				$this->db->exec($command);
				if(isset($GLOBALS["DEBUG"]) && $GLOBALS["DEBUG"] == true){ echo $command . "<br />\n"; }
				return true;
			} catch(PDOException $e){
				error_log($this->dbType . ' update request error: ' . $e->getMessage());
				return false;
			}
		}
	
		public function delete($name, $where){
			try {
				$command = "DELETE FROM $name WHERE $where";
				$this->db->exec($command);
				if(isset($GLOBALS["DEBUG"]) && $GLOBALS["DEBUG"] == true){ echo $command . "<br />\n"; }
				return true;
			} catch(PDOException $e){
				error_log($this->dbType . ' delete request error: ' . $e->getMessage());
				return false;
			}
		}
	}
?>
