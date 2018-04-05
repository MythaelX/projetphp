<?php
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
?>
