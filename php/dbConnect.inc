<?php
	/* Connexion à la base de données */
	if($_SERVER["HTTP_HOST"] == "127.0.0.1"){
		$bdd = new Bdd("mysql", "127.0.0.1:3306", "user2", "user2", "user2");
	} else if($_SERVER["HTTP_HOST"] == "localhost"){
		$bdd = new Bdd("mysql", "localhost:3306", "user2", "user2", "user2");
	} else {
		$bdd = new Bdd("mysql", "172.31.4.25:3306", "user2", "user2", "user2");
	}
?>
