<?php
	class Param {
		public $libelle;
		public $corde;
		public $tmax;
		public $tmaxmm;
		public $fmax;
		public $fmaxmm;
		public $nb_points;
		public $interval;

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

	class Cambrure{
		public $x;
		public $t;
		public $f;
		public $yintra;
		public $yextra;
		public $igx;
		
		function __construct($x,$t,$f,$yintra,$yextra,$igx){
			$this->x=$x;
			$this->t=$t;
			$this->f=$f;
			$this->yintra=$yintra;
			$this->yextra=$yextra;
			$this->igx=$igx;
		}
	}
?>
