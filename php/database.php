
<?php
require_once("../PHPClass/bdd.php");
if($_SERVER["HTTP_HOST"] == "127.0.0.1"){
  $bdd = new Bdd("mysql", "127.0.0.1:3306", "user2", "user2", "user2");
} else if($_SERVER["HTTP_HOST"] == "localhost"){
  $bdd = new Bdd("mysql", "localhost:3306", "user2", "user2", "user2");
} else {
  $bdd = new Bdd("mysql", "172.31.4.25:3306", "user2", "user2", "user2");
}

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
