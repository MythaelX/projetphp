<?php
	class Bdd{
		public $db;
		private $req;
		private $dbType;
		
		/* Constructeur de la classe*/
		function __construct($type, $host, $name = "", $user = "", $pass = ""){
			/* Tableau des types de bases de données */
			$array = array(
				"mysql" => "MySQL",
				"sqlite" => "SQLite"
			);
			
			$this->dbType = "";
			
			/* Création de PDO selon le type choisit */
			if(isset($type) && strtolower($type) == strtolower($array["sqlite"])){
				/* SQLite */
				$this->dbType = $array["sqlite"];
				
				try {
					$this->db = new PDO("sqlite:" . $host);
				} catch(PDOException $e){
					error_log($this->dbType . ' connect error: ' . $e->getMessage());
					die();
				}
			} else if(isset($type) && strtolower($type) == strtolower($array["mysql"])){
				/* MySQL */
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
				/* En cas d'erreur, précise les types disponibles */
				$error_text = "BDD error: You have to choose a bdd type between ";
				
				foreach($array as $key => $val){
					$error_text .= strtolower($val) . " | ";
				}
				
				error_log($error_text);
				die();
			}
		}
		
		/* Vérification et protection des données */
		private function secureValues($val){
			$val = explode("'", $val);
			$val = implode("\"", $val);
		
			return $val;
		}
		
		/* Utilisation de la fonction SELECT */
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
		
		/* Utilisation de la fonction SELECT et conversion de la réponse JSON */
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
		
		/* Utilisation de la fonction INSERT */
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
		
		/* Utilisation de la fonction UPDATE */
		public function update($name, $val, $opts=""){
			$vals = explode(", ", $val);
				for($i = 0; $i < sizeOf($vals); ++$i){
					if(strrpos($vals[$i], " = ") !== false){
						$valss = explode(" = ", $vals[$i]);
						
						$valss[0] = "`" . $valss[0] . "`";
						$valss[1] = $this->secureValues($valss[1]);
						
						$vals[$i] = implode(" = ", $valss);
					} else {
						$valss = explode("=", $vals[$i]);
						
						$valss[0] = "`" . $valss[0] . "`";
						$valss[1] = $this->secureValues($valss[1]);
						
						$vals[$i] = implode(" = ", $valss);
					}
				}
			$val = implode(", ", $vals);
		
			try {
				$command = "UPDATE $name SET $val $opts";
				$this->db->exec($command);
				
				if(isset($GLOBALS["DEBUG"]) && $GLOBALS["DEBUG"] == true){ echo $command . "<br />\n"; }
				
				return true;
			} catch(PDOException $e){
				error_log($this->dbType . ' update request error: ' . $e->getMessage());
				return false;
			}
		}
		
		/* Utilisation de la fonction DELETE */
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
		
		/* Récupération du dernier identifiant générer */
		public function getId(){
			try {
				return $this->db->lastInsertId();
			} catch(PDOException $e){
				error_log($this->dbType . ' getId request error: ' . $e->getMessage());
				return false;
			}
		}
	}
?>
