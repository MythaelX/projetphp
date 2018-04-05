<?php
	session_start();
	require_once("../PHPClass/getter.php");
	require_once("../PHPClass/bdd.php");
	
	$res = nextRes();
	
	if($_SERVER["HTTP_HOST"] == "127.0.0.1"){
		$bdd = new Bdd("mysql", "127.0.0.1:3306", "chen-co.corp", "user2", "user2");
	} else {
		$bdd = new Bdd("mysql", "172.31.4.25:3306", "user2", "user2", "user2");
	}
	
	echo $res . "\n";
	
	switch($type){
		case "POST":
			echo "post id = " . $_POST["id_param"] . "\n";
			var_dump($_SESSION);
			unset($_SESSION["show"], $_SESSION["edit"]);
			switch($res){
				case "show":
					$_SESSION["show"] = $_POST["id_param"];
					break;
				case "edit":
					$_SESSION["edit"] = $_POST["id_param"];
					break;
				case "delete":
					echo "deletion cambrure" . "\n";
					$bdd->delete("cambrure", "id_param=".$_POST["id_param"]);
					echo "deletion parametre" . "\n";
					$bdd->delete("parametre", "id=".$_POST["id_param"]);
					echo "deletion" . "\n";
					break;
			}
			break;
		case "GET":
			break;
		case "PUT":
			break;
		case "DELETE":
			break;
		default:
			
	}
?>
