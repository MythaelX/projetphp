<?php
	require_once("class.php");
	
	/* Fonction pour calculer les points selon les paramètres rentrés dans le formulaires */
	function computePoints($param){
		$i = 0;
		$tprec = 0;
		
		for($index = 0; $index < intval($param->nb_points); ++$index){
			$t = -1 * (1.015 * pow(($i/$param->corde), 4) - 2.843 * pow(($i/$param->corde), 3) + 3.516 * pow(($i/$param->corde), 2) + 1.26 * ($i/$param->corde) - 2.969 * sqrt($i/$param->corde)) * $param->tmaxmm;
			$f = -4 * (pow(($i/$param->corde), 2) - ($i/$param->corde)) * $param->fmaxmm;
			$yintra = $f + $t/2;
			$yextra = $f - $t/2;
			
			$h = ($t + $tprec)/2;
			$b = $param->interval;
			$igz = $b * pow($h, 3) / 12;
			
			$points[$index] = new Cambrure($i, $t, $f, $yintra, $yextra, $igz);
			
			$i += $param->interval;
			$tprec = $t;
		}
		
		/* Retourne le tableau de Cambrures */
		return $points;
	}
	
	function createCSV($id){
		require_once("../PHPClass/bdd.php");
		require("dbConnect.inc");
	
		$datasP = $bdd->select("parametre", "*", "WHERE id=".$id);
		$datas = $bdd->select("cambrure", "*", "WHERE id_param=".$id);

		for($i = 0; $i < sizeOf($datas); ++$i){
			$x[$i] = floatval($datas[$i]["x"]);
			$yi[$i] = floatval($datas[$i]["yintra"]);
			$ye[$i] = floatval($datas[$i]["yextra"]);
			$y[$i] = (floatval($datas[$i]["yintra"]) + floatval($datas[$i]["yextra"])) / 2;
		}

		$data1 = $yi;
		$data2 = $ye;
		$data3 = $y;
	
		// Create the filename
		$csvfile = $datasP[0]["libelle"] . "_" . uniqid("", true) . ".csv";
		
		return $csvfile;
	}
?>
