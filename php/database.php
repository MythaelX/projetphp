
<?php
require_once("../PHPClass/bdd.php");
ECHO "OKk";
//$bdd = new Bdd("mysql","172.31.4.25:3306","user2","user2", "user2");
$bdd= new PDO("mysql:host=172.31.4.25;dbname=user2;charset=UTF8;", "user2", "user2");
ECHO "OK1";
if (isset($_POST['libelle'])) {
  $libelle=$_POST['libelle'];
  $date=$_POST['date'];
  $corde=$_POST['corde'];
  $tmax=$_POST['tmax'];
  $tmaxmm=($tmax/100)*$corde;
  $fmax=$_POST['fmax'];
  $fmaxmm=($fmax/100)*$corde;
  $nb_points=$_POST['nb_points']
  $interval=$_POST['interval']
  bdd->insert("parametre", $val);
}

  ?>
