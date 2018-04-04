<?php
	require_once("PHPClass/class-Head_Creator.php");
	
	$head = new Head_Creator("./");
	
	$head->head_title("Site de test");
	$head->head_charset("utf-8");
	
	/* Styles du site */
		$head->head_style("design/css/home_made.less");
		$head->head_style("design/css/style.less");
	/******************/
	
	$head->head_script("JSClass/_script.js");
	$head->head_script("JSClass/ajax.js");
	$head->head_script("JSClass/less.min.js");
	$head->head_script("JSClass/js.cookie.js");
	
	/* Scripts du site */
		
	/*******************/
	
	/* Scripts personnels */
		
	/***************************/
	
	$head->show();
?>
	<body id="body">
		<header><?php require_once("php/header.temp.inc"); ?></header>
		<nav><?php require_once("php/nav.temp.inc"); ?></nav>
		<main><?php require_once("php/main.temp.inc"); ?></main>
		<footer><?php require_once("php/footer.temp.inc"); ?></footer>
	</body>
</html>
