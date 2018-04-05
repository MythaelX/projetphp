
<?php
require_once("../PHPClass/bdd.php");
class Param(){
    $libelle;
    $corde;
    $tmax;
    $tmaxmm;
    $fmax;
    $fmaxmm;
    $nb_points;
    $interval;
    function __construct($libelle,$corde,$tmax,$tmaxmm,$fmax,$fmaxmm,$nb_points,$interval){
      $this->libelle=$libelle;
      $this->corde=$corde;
      $this->tmax=$tmax;
      $this->tmaxmm=$tmaxmm;
      $this->fmax=$fmax;
      $this->fmaxmm=$fmaxmm;
      $this->nb_points=$nb_points;
      $this->interval=$interval;
    }
}

class Cambrure(){
  $x;
  $t;
  $f;
  $yintra;
  $yextra;
  $igx;
  function __construct($x,$t,$f,$yintra,$yextra,$igx){
    $this->x=$x;
    $this->t=$t;
    $this->f=$f;
    $this->yintra=$yintra;
    $this->yextra=$yextra;
    $this->$igx=$igx;

  }
}
if($_SERVER["HTTP_HOST"] == "127.0.0.1"){
  $bdd = new Bdd("mysql", "127.0.0.1:3306", "user2", "user2", "user2");
} else if($_SERVER["HTTP_HOST"] == "localhost"){
  $bdd = new Bdd("mysql", "localhost:3306", "user2", "user2", "user2");
} else {
  $bdd = new Bdd("mysql", "172.31.4.25:3306", "user2", "user2", "user2");
}

if (isset($_POST['libelle'])) {
  $libelle=$_POST['libelle'];
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
