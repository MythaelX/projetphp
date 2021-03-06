<?php
class Graphique {
	private $graph;
	private $y;
	private $ticks;
	private $x;

	function __construct($w, $h){
		require_once('../jpgraph/jpgraph.php');
		require_once('../jpgraph/jpgraph_line.php');

		// Créer le graphique
		$this->graph = new Graph(1200, 780);
		$this->graph->cleartheme();
		$this->graph->SetScale("linlin");

		$this->x = false;
	}

	public function addDatas($points){
		$pos = sizeOf($this->y);
		$this->y[$pos] = $points;
	}

	public function setTitle($title){
		$this->graph->title->Set($title);
		$this->graph->title->SetFont(FF_FONT1, FS_BOLD);
	}

	public function setX($ticks, $labels){
		$this->graph->xaxis->title->Set("X");
		$this->graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);
		$this->graph->xaxis->SetPos('min');
		$this->graph->xaxis->SetMajTickPositions($ticks, $labels);
		$this->ticks = $ticks;
		$this->x = true;
	}

	public function saveJpg($filename){
		$margin =  5;

		if($this->x === true){
			$xmin = $this->ticks[0];
			$xmax = $this->ticks[sizeOf($this->ticks)-1] + $margin;
		} else {
			$xmin = 0;
			$xmin -= $margin;

			$xmax = 0;
			for($i = 0; $i < sizeOf($this->y); ++$i){
				$xmax = max($xmax, sizeOf($this->y[$i]));
			}
			$xmax += $margin;
		}

		//Initialisation des graphiques
		$this->graph->SetScale("linlin", 0, 0, $xmin, $xmax);
		$this->graph->SetShadow();
		$this->graph->img->SetMargin(40, 30, 20, 40);

		//Création des lignes
		for($i = 0; $i < sizeOf($this->y); ++$i){
			$lines[$i] = new LinePlot($this->y[$i]);
		}

		//et ajout au graphique
		for($i = 0; $i < sizeOf($lines); ++$i){
			$this->graph->add($lines[$i]);
		}

		//Propriétés de l'axe Y
		$this->graph->yaxis->title->Set("Y");
		$this->graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);

		//Initialise le format d'image
		$this->graph->SetImgFormat("jpeg", 90);
		$this->graph->Stroke($filename);
	}
}
?>
