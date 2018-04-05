
<?php
require_once("../PHPClass/bdd.php");
require_once("../php/class.php");

if($_SERVER["HTTP_HOST"] == "127.0.0.1"){
  $bdd = new Bdd("mysql", "127.0.0.1:3306", "user2", "user2", "user2");
} else if($_SERVER["HTTP_HOST"] == "localhost"){
  $bdd = new Bdd("mysql", "localhost:3306", "user2", "user2", "user2");
} else {
  $bdd = new Bdd("mysql", "172.31.4.25:3306", "user2", "user2", "user2");
}

if (isset($_POST['libelle'])) {
  $parametre= new Para($_POST['libelle'],$_POST['corde'],$_POST['tmax'],(($tmax/100)*$corde),$_POST['fmax'],(($fmax/100)*$corde),=$_POST['nb_points'],$_POST['interval']);
  //bdd->insert("parametre", $val);
}

  ?>
