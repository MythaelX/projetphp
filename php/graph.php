<?php
class Graphique {
	private $graph;
	private $y;
	private $ticks;
	private $x;
	
	function __construct($w, $h){
		require_once('../jpgraph/jpgraph.php');
		require_once('../jpgraph/jpgraph_line.php');
		
		// Create the graph. These two calls are always required
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
			$xmin = $this->ticks[0] - $margin;
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
		
		//Initializing of the graph
		$this->graph->SetScale("linlin", 0, 0, $xmin, $xmax);
		$this->graph->SetShadow();
		$this->graph->img->SetMargin(40, 30, 20, 40);
		
		// Create the lines
		for($i = 0; $i < sizeOf($this->y); ++$i){
			$lines[$i] = new LinePlot($this->y[$i]);
		}

		// ...and add it to the graph
		for($i = 0; $i < sizeOf($lines); ++$i){
			$this->graph->add($lines[$i]);
		}
		
		//Set y-axis properties
		$this->graph->yaxis->title->Set("Y");
		$this->graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
		
		// Set the img format
		$this->graph->SetImgFormat("jpeg", 90);
		$this->graph->Stroke($filename);
	}
}

function createGraph($id){
	require_once("../PHPClass/bdd.php");
	require("dbConnect.inc");
	
	$datasP = $bdd->select("parametre", "*", "WHERE id=".$id);
	$datas = $bdd->select("cambrure", "*", "WHERE id_param=".$id);

	for($i = 0; $i < sizeOf($datas); ++$i){
		$yi[$i] = floatval($datas[$i]["yintra"]);
		$ye[$i] = floatval($datas[$i]["yextra"]);
		$y[$i] = (floatval($datas[$i]["yintra"]) + floatval($datas[$i]["yextra"])) / 2;
		$igz[$i] = floatval($datas[$i]["igz"]);
	}
	
	/* X values for X axis of the first graph */
		$j = 0;
		$i = 0;
		$add = 10;
		for(; $i < sizeOf($datas);){
			$x["val"][$i] = floatval($datas[$j]["x"]);
			$x["pos"][$i] = floatval($j);
		
			$i ++;
		
			if($j + $add < sizeOf($datas)){
				$j += $add;
			} else {
				break;
			}
		}
	
		if($j < sizeOf($datas) + $add){
			$x["val"][$i] = floatval($datas[sizeOf($datas)-1]["x"]);
			$x["pos"][$i] = floatval(sizeOf($datas)-1);
		}
	/******************************************/
	/* X values for X axis of the second graph */
		$fmax["val"][0] = 0;
		$fmax["pos"][0] = 0;
		
		$fmax["val"][1] = floatval($datasP[sizeOf($datasP)-1]["fmax"]);
		$fmax["pos"][1] = floatval(sizeOf($datasP));
	/*******************************************/
	
	// Create the filename
	$imgfile = $datasP[0]["libelle"] . "_" . uniqid("", true);
	
	// Cambrure graph
	$cambrure = new Graphique(1200, 780);
	
	$cambrure->setTitle($datasP[0]["libelle"]);
	
	$cambrure->addDatas($yi);
	$cambrure->addDatas($ye);
	$cambrure->addDatas($y);
	
	$cambrure->setX($x["pos"], $x["val"]);
	
	$cambrure->saveJpg("../design/img/" . $imgfile . "_cambrure.jpg");
	
	//Solidity graph
	$solidity = new Graphique(1200, 780);
	
	$solidity->setTitle($datasP[0]["libelle"]);
	
	$solidity->addDatas($igz);
	
	$solidity->setX($fmax["pos"], $fmax["val"]);
	
	$solidity->saveJpg("../design/img/" . $imgfile . "_solidite.jpg");
	
	// Return the graph name
	return $imgfile;
}
?>
