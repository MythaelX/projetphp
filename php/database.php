
<?php
require_once("../PHPClass/bdd.php");
require_once("../php/functions.php");

$DEBUG=true;

if($_SERVER["HTTP_HOST"] == "127.0.0.1"){
  $bdd = new Bdd("mysql", "127.0.0.1:3306", "user2", "user2", "user2");
} else if($_SERVER["HTTP_HOST"] == "localhost"){
  $bdd = new Bdd("mysql", "localhost:3306", "user2", "user2", "user2");
} else {
  $bdd = new Bdd("mysql", "172.31.4.25:3306", "user2", "user2", "user2");
}

if (isset($_POST['libelle'])) {
  $parametre = new Param($_POST['libelle'],$_POST['corde'],$_POST['tmax'],(($_POST['tmax']/100)*$_POST['corde']),$_POST['fmax'],(($_POST['fmax']/100)*$_POST['corde']),$_POST['nb_points'],$_POST['interval']);
  $points = computePoints($parametre);
  if($_POST['action']=="post"){
    $bdd->insert("parametre", "NULL, '".$parametre->libelle."', ".$parametre->corde.", ".$parametre->tmax.", ".$parametre->tmaxmm.", ".$parametre->fmax.", ".$parametre->fmaxmm.", ".$parametre->nb_points.", NOW(), 'azerty', 'azerty'");
    for ($i=0; $i <sizeof($points); $i++) {
      $bdd->insert("cambrure","NULL,".$points[$i]->x.",".$points[$i]->t.",".$points[$i]->f.",".$points[$i]->yintra.",".$points[$i]->yextra.",".$points[$i]->id_param.",".$points[$i]->igz);
    }
  }else if($_POST['action']=="update"){
    $bdd->update("parametre","libelle=".$parametre->libelle." AND corde=".$parametre->corde." AND tmax=".$parametre->tmax." AND tmaxmm=".$parametre->tmaxmm." AND fmax=".$parametre->fmax."AND fmaxmm=".$parametre->fmaxmm."AND nb_points=".$parametre->nb_points);
    $
    for ($i=0; $i <sizeof($points); $i++) {
      $bdd->insert("cambrure","NULL,".$points[$i]->x.",".$points[$i]->t.",".$points[$i]->f.",".$points[$i]->yintra.",".$points[$i]->yextra.",".$points[$i]->id_param.",".$points[$i]->igz." WHERE id=".$_POST['id_param']);
    }
  }

}

  ?>
