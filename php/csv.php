<?php
function createCSV($id){
  require_once("../PHPClass/bdd.php");
  require("dbConnect.inc");
  $datasP = $bdd->select("parametre", "*", "WHERE id=".$id);
  $datas = $bdd->select("cambrure", "*", "WHERE id_param=".$id);

  //tableau des données
  $data_csv=array_merge($datasP+$datas);

  // Create the filename
  $csvfile = $datasP[0]["libelle"] . "_" . uniqid("", true) . ".csv";
  $fp = fopen("../csv/".$csvfile, 'w+');

  foreach ($data_csv as $fields) {
    fputcsv($fp, $fields);
  }

  fclose($fp);

  return $csvfile;
}
?>
