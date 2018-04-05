<?php
	require_once("PHPClass/bdd.php");
	require_once("PHPClass/class-Head_Creator.php");

	$head = new Head_Creator("./");

	$head->head_title("Chen-co.corp");
	$head->head_charset("utf-8");

	/* Styles du site */
		$head->head_style("design/css/home_made.less");
		$head->head_style("design/css/style.less");
	/******************/

	$head->head_style("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css");

	$head->head_script("JSClass/_script.js");
	$head->head_script("JSClass/ajax.js");
	$head->head_script("JSClass/less.min.js");
	$head->head_script("JSClass/js.cookie.js");

	/* Scripts du site */

	/*******************/

	/* Scripts personnels */
		$head->head_script("js/entries.js");
	/***************************/

	$head->head_script("https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js");
	$head->head_script("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");

	$head->show();
?>
	<body id="body">
		<header><?php require_once("php/header.temp.inc"); ?></header>
		<nav class="navbar navbar-default"><?php require_once("php/nav.temp.inc"); ?></nav>
		<main>
			<?php require_once("php/paramForm.inc"); ?>
		</main>
		<footer><?php require_once("php/footer.temp.inc"); ?></footer>
	</body>
</html>
