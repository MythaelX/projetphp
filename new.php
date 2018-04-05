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

	/***************************/

	$head->head_script("https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js");
	$head->head_script("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js");

	$head->show();
?>
	<body id="body">
		<header><?php require_once("php/header.temp.inc"); ?></header>
		<nav class="navbar navbar-default"><?php require_once("php/nav.temp.inc"); ?></nav>
		<main>
			<form method="post" class="container" action="php/database.php">
				<div class="form-group">
					<label for="libelle">Intitulé :</label><br />
					<input type="text" class="form-control" name="libelle" />
				</div>
				<!--<label for="">Date:<br />
				<input type="date" name="date"/>
				<br />-->
				<div class="form-group">
					<label for="corde">Taille de la corde (en mm):<br />
					<input type="number" class="form-control" name="corde"/>
				</div>
				<div class="form-group">
					<div class="form-group" style="display: inline-block; width: 45%;">
						<label for="tmax">Tmax (en %) :<br />
						<input type="number" class="form-control" name="tmax" />
					</div>
					<div class="form-group" style="display: inline-block; width: 45%;">
						<label for="fmax">Fmax (en %) :<br />
						<input type="number" class="form-control" name="fmax" />
					</div>
				</div>
				<div class="form-group">
					<div class="form-group" style="display: inline-block; width: 45%;">
						<label for="nb_points">Nombre de points pour les calculs :<br />
						<input type="number" class="form-control" name="nb_points" />
					</div>
					<div class="form-group" style="display: inline-block; width: 45%;">
						<label for="interval">Interval entre les points:<br />
						<input type="number" class="form-control" name="interval" />
					</div>
				</div>
				<input type="submit" value="Envoyer" />
				</div>
			</form>
		</main>
		<footer><?php require_once("php/footer.temp.inc"); ?></footer>
	</body>
</html>
