<?php
	session_start();
	require_once("../PHPClass/getter.php");
	require_once("../PHPClass/bdd.php");
	
	$res = nextRes();
	
	/* Connexion à la base de données */
	if($_SERVER["HTTP_HOST"] == "127.0.0.1"){
		$bdd = new Bdd("mysql", "127.0.0.1:3306", "user2", "user2", "user2");
	} else if($_SERVER["HTTP_HOST"] == "localhost"){
		$bdd = new Bdd("mysql", "localhost:3306", "user2", "user2", "user2");
	} else {
		$bdd = new Bdd("mysql", "172.31.4.25:3306", "user2", "user2", "user2");
	}
	
	echo $res . "\n";
	
	switch($type){
		case "POST":
			/* On efface les variables utilisées sur le site pour tout faire propre */
			unset($_SESSION["show"], $_SESSION["edit"], $_SESSION["edit_act"]);
			
			/* On remplit uniquement la/les variable(s) utilisée(s) */
			switch($res){
				case "show":
					$_SESSION["show"] = $_POST["id_param"];
					break;
				case "edit":
					$_SESSION["edit"] = $_POST["id_param"];
					$_SESSION["edit_act"] = $_POST["action"];
					break;
				case "delete":
					/* On supprime le paramètre et les cambrures demandées */
					$bdd->delete("cambrure", "id_param=".$_POST["id_param"]);
					$bdd->delete("parametre", "id=".$_POST["id_param"]);
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
