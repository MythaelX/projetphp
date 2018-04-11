<?php
function createCSV($id){
  require_once("../PHPClass/bdd.php");
  require("dbConnect.inc");
  $datasP = $bdd->select("parametre", "*", "WHERE id=".$id);
  $datas = $bdd->select("cambrure", "*", "WHERE id_param=".$id);

  $data_csv = array (
    array('aaa', 'bbb', 'ccc', 'dddd'),
    array('123', '456', '789'),
    array('"aaa"', '"bbb"')
  );
  for($i = 0; $i < sizeOf($datas); ++$i){
    //ajout de datas dans le tableau
  }

  // Create the filename
  $csvfile = $datasP[0]["libelle"] . "_" . uniqid("", true) . ".csv";
  $fp = fopen($csvfile, 'w+');

  foreach ($data_csv as $fields) {
    fputcsv($fp, $fields);
  }

  fclose($fp);
}
?>
