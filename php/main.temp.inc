<?php
	require_once("./PHPClass/bdd.php");
	
	if($_SERVER["HTTP_HOST"] == "127.0.0.1"){
		$bdd = new Bdd("mysql", "127.0.0.1:3306", "chen-co.corp", "user2", "user2");
	} else {
		$bdd = new Bdd("mysql", "172.31.4.25:3306", "user2", "user2", "user2");
	}
?>
<section><?php require_once("section.temp.inc"); ?></section>
<aside><?php require_once("aside.temp.inc"); ?></aside>
