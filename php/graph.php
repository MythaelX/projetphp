<?php
require_once("Graphique.php");

function createGraph($id){
	require_once("../PHPClass/bdd.php");
	require("dbConnect.inc");

	$datasP = $bdd->select("parametre", "*", "WHERE id=".$id);
	$datas = $bdd->select("cambrure", "*", "WHERE id_param=".$id);

	for($i = 0; $i < sizeOf($datas); ++$i){
		$yi[$i] = floatval($datas[$i]["yintra"]);
		$ye[$i] = floatval($datas[$i]["yextra"]);
		$y[$i] = (floatval($datas[$i]["yintra"]) + floatval($datas[$i]["yextra"])) /2;

		$vmax = ($y[$i])/2;
		$igz[$i] = floatval($datas[$i]["igz"]*100);
		$solidite[$i] = $igz[$i]/$vmax;
	}

	/* Valeurs de x pour le premier graphique */
		$j = 0;
		$i = 0;
		$add = 10;
		for(; $i < sizeOf($datas);){
			$x["val"][$i] = floatval($datas[$j]["x"]);
			$x["pos"][$i] = floatval($j);

			$i ++;

			if($j + $add < sizeOf($datas)){
				$j += $add;
			} else {
				break;
			}
		}

		if($j < sizeOf($datas) + $add){
			$x["val"][$i] = floatval($datas[sizeOf($datas)-1]["x"]);
			$x["pos"][$i] = floatval(sizeOf($datas)-1);
		}
	/******************************************/
	/* Valeurs de x pour le second graphique */
		/*
		for($i = 0;$i<$datasP[0]["fmax"]+2;++$i){
			$fmax["pos"][$i] =$i*2;
			$fmax["val"][$i] =$i*2;
		}
		*/
	/*******************************************/

	// Créer le nom du fichier
	$imgfile = $datasP[0]["libelle"] . "_" . uniqid("", true);

	// Graphique de cambrure
	$cambrure = new Graphique(1200, 780);

	$cambrure->setTitle($datasP[0]["libelle"]);

	$cambrure->addDatas($yi);
	$cambrure->addDatas($ye);
	$cambrure->addDatas($y);

	$cambrure->setX($x["pos"], $x["val"]);

	$cambrure->saveJpg("../design/img/" . $imgfile . ".jpg");

	/* Non fait car demandé de l'ignorer */
	/*
	// Graphique de solidité
	$solidity = new Graphique(1200, 780);

	$solidity->setTitle($datasP[0]["libelle"]);

	$solidity->addDatas($igz);
	$solidity->addDatas($solidite);

	$solidity->setX($fmax["pos"], $fmax["val"]);

	$solidity->saveJpg("../design/img/" . $imgfile . "_solidite.jpg");
	*/
	/*************************************/

	// Renvoie le nom du graphique
	return $imgfile;
}
?>
