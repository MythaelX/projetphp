<?php
function createCSV($id){
	require_once("../PHPClass/bdd.php");
	require("dbConnect.inc");
	require_once("../PHPClass/_functions.php");
	$datasP = $bdd->select("parametre", "libelle, corde, tmax, tmaxmm, fmax, fmaxmm", "WHERE id=".$id);
	$datas = $bdd->select("cambrure", "x, t, f, yintra, yextra, igz", "WHERE id_param=".$id);

	//Création du nom du fichier et ouverture du fichier à éditer
	$csvfile = $datasP[0]["libelle"] . "_" . uniqid("", true) . ".csv";
	$fp = fopen("../csv/" . $csvfile, 'w+');

	if($fp === false){
		echo "Error in the file";
		exit(-1);
	}

	//Création du tableau des données du fichier csv
	$i=0;
	foreach ($datas[0] as $key => $val){
		$data_csv[0][$i++] = $key;
	}

	$index = 0;
	foreach ($datasP[0] as $key => $val){
		$data_csv[0][$i + $index] = $key;
		$index++;
	}

	$data_csv = array_merge($data_csv, $datas);

	$index = 0;
	foreach ($datasP[0] as $key => $val){
		$data_csv[1][$i + $index] = $val;
		$index++;
	}

	$data_csv = replace_all(".", ",", $data_csv);

	//insertion ligne par ligne des données
	foreach ($data_csv as $fields) {
		fputcsv($fp, $fields, ";");
	}

	fclose($fp);

	return $csvfile;
}
?>
