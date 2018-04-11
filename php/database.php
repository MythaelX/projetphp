<?php
	require_once("functions.php");
	require_once("graph.php");
	require_once("../PHPClass/bdd.php");
	require_once("dbConnect.inc");
		
	//$DEBUG = true;

	/* Traitement des données si la variable $_POST["libelle"], donc si des données ont été envoyées */
	if (isset($_POST['libelle'])) {
		/* Création d'un objet de classe Param */
		$parametre = new Param($_POST['libelle'],
							   $_POST['corde'],
							   $_POST['tmax'],
							   (($_POST['tmax']/100)*$_POST['corde']),
							   $_POST['fmax'],
							   (($_POST['fmax']/100)*$_POST['corde']),
							   $_POST['nb_points'],
							   $_POST['corde']/$_POST['nb_points']);
		
		/* Création des différents points selon l'objet Param */
		$points = computePoints($parametre);
		
		if($_POST['action']=="post"){
			/* Si c'est un ajout */
			$bdd->insert("parametre",
						 "NULL, '" .
						 	$parametre->libelle . "', " .
						 	$parametre->corde . ", " .
						 	$parametre->tmax . ", " .
						 	$parametre->tmaxmm . ", " .
						 	$parametre->fmax . ", " .
						 	$parametre->fmaxmm . ", " .
						 	$parametre->nb_points . ", NOW(), '', ''");
			$id = $bdd->getId();
			
			for ($i=0; $i <sizeof($points); $i++) {
				$bdd->insert("cambrure",
							 "NULL, " .
							 	$points[$i]->x . ", " .
							 	$points[$i]->t . ", " .
							 	$points[$i]->f . ", " .
							 	$points[$i]->yintra . ", " .
							 	$points[$i]->yextra . ", " .
							 	$id . ", " . $points[$i]->igz);
			}
			
			$imgfile = createGraph($id);
			$csvfile = createCSV($id);
			
			$bdd->update("parametre",
						 "fic_img = '" . $imgfile .
						 	"', fic_csv = '" . $csvfile .
						 	"'",
						 "WHERE id = " . $id);
		} else if($_POST['action'] == "update"){
			/* Si c'est une modification */
			$bdd->update("parametre",
						 "libelle = '" . $parametre->libelle .
						 	"', corde = " . $parametre->corde .
						 	", tmax = " . $parametre->tmax .
						 	", tmaxmm = " . $parametre->tmaxmm .
						 	", fmax = " . $parametre->fmax .
						 	", fmaxmm = " . $parametre->fmaxmm .
						 	", nb_points = " . $parametre->nb_points,
						 "WHERE id = " . $_POST['id_param']);
			$bdd->delete("cambrure",
						 "id_param = " . $_POST['id_param']);
			
			for ($i=0; $i <sizeof($points); $i++) {
				$bdd->insert("cambrure",
							 "NULL, " .
							 	$points[$i]->x . ", " .
							 	$points[$i]->t . ", " .
							 	$points[$i]->f . ", " .
							 	$points[$i]->yintra . ", " .
							 	$points[$i]->yextra . ", " .
							 	$_POST['id_param'] . ", " .
							 	$points[$i]->igz);
			}
			
			$imgfile = createGraph($_POST['id_param']);
			$csvfile = createCSV($_POST['id_param']);
			
			$bdd->update("parametre",
						 "fic_img = '" . $imgfile .
						 	"', fic_csv = '" . $csvfile . "'",
						 "WHERE id = " . $_POST['id_param']);
		}
	}

	/* Retour à la page d'accueil */
	header('Location: ../');
?>
