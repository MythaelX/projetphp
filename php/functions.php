<?php
	require_once("class.php");
	
	function computePoints($param){
		$points;
		$index = 0;
		for($i = 0; $i < $param->nb_points; $i += $param->interval){
			$t = -1 * (1,015 * pow(($i/$param->corde), 4) - 2,843 * pow(($i/$param->corde), 3) + 3,516 * pow(($i/$param->corde), 2) + 1,26 * ($i/$param->corde) - 2,969 * sqrt($i/$param->corde)) * $param->tmaxmm;
			$f = -4 * (pow(($i/$param->corde), 2) - ($i/$param->corde)) * U$8;
			$yintra = $f + $t/2;
			$yextra = $f - $t/2;
			
			$h = 0;
			$b = 0;
			$igz = $b * pow($h, 3) / 12;
			
			$points[$index] = new Cambrure($i, $t, $f, $yintra, $yextra, $igz);
		}
	}
?>
