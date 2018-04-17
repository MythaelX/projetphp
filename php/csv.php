<?php
function createCSV($id){
  require_once("../PHPClass/bdd.php");
  require("dbConnect.inc");
  $datasP = $bdd->select("parametre", "libelle, corde, tmax, tmaxmm, fmax, fmaxmm, nb_points", "WHERE id=".$id);
  $datas = $bdd->select("cambrure", "x, t, f, yintra, yextra, igz", "WHERE id_param=".$id);


  // Create the filename
  $csvfile = $datasP[0]["libelle"] . "_" . uniqid("", true) . ".csv";

  $fp = fopen("../csv/".$csvfile, 'w+');
  $i=0;
  foreach ($datas[0] as $key => $fields){
    $data_csv[0][$i]=$key;
    $i++;
  }
  //tableau des données
  $data_csv= array_merge($keys, array_merge($datasP, $datas));
  echo "<pre>";
  print_r($data_csv);
  echo "</pre>";
  foreach ($data_csv as $fields) {
    fputcsv($fp, $fields);
  }

  fclose($fp);

  return $csvfile;
}
?>
