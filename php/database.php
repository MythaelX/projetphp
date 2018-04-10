<?php
	require_once("../PHPClass/bdd.php");
	require_once("../php/functions.php");
	
	/* Connexion à la base de données */
	if($_SERVER["HTTP_HOST"] == "127.0.0.1"){
		$bdd = new Bdd("mysql", "127.0.0.1:3306", "user2", "user2", "user2");
	} else if($_SERVER["HTTP_HOST"] == "localhost"){
		$bdd = new Bdd("mysql", "localhost:3306", "user2", "user2", "user2");
	} else {
		$bdd = new Bdd("mysql", "172.31.4.25:3306", "user2", "user2", "user2");
	}

	/* Traitement des données si la variable $_POST["libelle"], donc si des données ont été envoyées */
	if (isset($_POST['libelle'])) {
		/* Création d'un objet de classe Param */
		$parametre = new Param($_POST['libelle'], $_POST['corde'], $_POST['tmax'],(($_POST['tmax']/100)*$_POST['corde']), $_POST['fmax'],(($_POST['fmax']/100)*$_POST['corde']), $_POST['nb_points'], $_POST['interval']);
		
		/* Création des différents points selon l'objet Param */
		$points = computePoints($parametre);
		
		if($_POST['action']=="post"){
			/* Si c'est un ajout */
			$bdd->insert("parametre", "NULL, '" . $parametre->libelle . "', " . $parametre->corde . ", " . $parametre->tmax . ", " . $parametre->tmaxmm . ", " . $parametre->fmax . ", " . $parametre->fmaxmm . ", " . $parametre->nb_points . ", NOW(), 'azerty', 'azerty'");
			$id = $bdd->getId();
			
			for ($i=0; $i <sizeof($points); $i++) {
				$bdd->insert("cambrure", "NULL, " . $points[$i]->x . ", " . $points[$i]->t . ", " . $points[$i]->f . ", " . $points[$i]->yintra . ", " . $points[$i]->yextra . ", " . $id . ", " . $points[$i]->igz);
			}
		} else if($_POST['action']=="update"){
			/* Si c'est une modification */
			$bdd->update("parametre", "libelle = '".$parametre->libelle."', corde = ".$parametre->corde.", tmax = ".$parametre->tmax.", tmaxmm = ".$parametre->tmaxmm.", fmax = ".$parametre->fmax.", fmaxmm = ".$parametre->fmaxmm.", nb_points = ".$parametre->nb_points, "WHERE id = ".$_POST['id_param']);
			$bdd->delete("cambrure", "id_param = ".$_POST['id_param']);
			
			for ($i=0; $i <sizeof($points); $i++) {
				$bdd->insert("cambrure","NULL, ".$points[$i]->x.", ".$points[$i]->t.", ".$points[$i]->f.", ".$points[$i]->yintra.", ".$points[$i]->yextra.", ".$_POST['id_param'].", ".$points[$i]->igz);
			}
		}
	}

	/* Retour à la page d'accueil */
	header('Location: ../');
?>
