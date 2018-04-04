<?php
	require_once("PHPClass/bdd.php");
	require_once("PHPClass/class-Head_Creator.php");

	$head = new Head_Creator("./");

	$head->head_title("Site de test");
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

	/***************************/

	$head->head_script("https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js");
	$head->head_script("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");

	$head->show();
?>
	<body id="body">
		<header><?php require_once("php/header.temp.inc"); ?></header>
		<nav class="navbar navbar-default"><?php require_once("php/nav.temp.inc"); ?></nav>
		<main>
      <div class="container" >
      <form method="post" action="php/database.php"/>
        Label:<br/>
        <input type="text" name="libelle"/>
        <br/>
        Date:<br/>
        <input type="date" name="date"/>
        <br/>
        Corde:<br/>
        <input type="number" name="corde"/>
        <br/>
        tmax %:<br/>
        <input type="number" name="tmax"/>
        <br/>
        fmax %:<br/>
        <input type="number" name="fmax"/>
        <br/>
        nb_points:<br/>
        <input type="number" name="nb_points"/>
        <br/>
        interval entre les points:<br/>
        <input type="number" name="interval"/>
        <br/>
        <input type="submit" value="envoyer"/>
      </div>
    </form>
    </main>
		<footer><?php require_once("php/footer.temp.inc"); ?></footer>
	</body>
</html>
