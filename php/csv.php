<?php
function createCSV($id){
	require_once("../PHPClass/bdd.php");
	require("dbConnect.inc");
	$datasP = $bdd->select("parametre", "libelle, corde, tmax, tmaxmm, fmax, fmaxmm", "WHERE id=".$id);
	$datas = $bdd->select("cambrure", "x, t, f, yintra, yextra, igz", "WHERE id_param=".$id);


	// Create the filename and open the file in writting
	$csvfile = $datasP[0]["libelle"] . "_" . uniqid("", true) . ".csv";
	$fp = fopen("../csv/" . $csvfile, 'w+');

	if($fp === false){
		echo "Error in the file";
		exit(-1);
	}

	//Getting all the keys of the database
	$i=0;
	foreach ($datas[0] as $key => $val){
		$data_csv[0][$i++] = $key;
	}
	
	$index = 0;
	foreach ($datasP[0] as $key => $val){
		$data_csv[0][$i + $index] = $key;
		$index++;
	}
	
	//Array of all datas
	$data_csv = array_merge($data_csv, $datas);
	
	$index = 0;
	foreach ($datasP[0] as $key => $val){
		$data_csv[1][$i + $index] = $val;
		$index++;
	}

	foreach ($data_csv as $fields) {
		fputcsv($fp, $fields);
	}

	fclose($fp);

	return $csvfile;
}
?>
