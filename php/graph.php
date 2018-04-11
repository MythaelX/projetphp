<?php
function createGraph($id){
	require_once('../jpgraph/jpgraph.php');
	require_once('../jpgraph/jpgraph_line.php');

	require_once("../PHPClass/bdd.php");
	require("dbConnect.inc");
	
	$datasP = $bdd->select("parametre", "*", "WHERE id=".$id);
	$datas = $bdd->select("cambrure", "*", "WHERE id_param=".$id);

	for($i = 0; $i < sizeOf($datas); ++$i){
		$yi[$i] = floatval($datas[$i]["yintra"]);
		$ye[$i] = floatval($datas[$i]["yextra"]);
		$y[$i] = (floatval($datas[$i]["yintra"]) + floatval($datas[$i]["yextra"])) / 2;
	}
	for($i = 0; $i < sizeOf($datas); $i += 10){
		$x[$i] = floatval($datas[$i]["x"]);
	}

	$data1 = $yi;
	$data2 = $ye;
	$data3 = $y;
	
	// Create the filename
	$imgfile = $datasP[0]["libelle"] . "_" . uniqid("", true) . ".jpg";

	// Create the graph. These two calls are always required
	$graph = new Graph(1200, 780);
	$graph->cleartheme();
	$graph->SetScale("textlin");

	$graph->SetShadow();
	$graph->img->SetMargin(40, 30, 20, 40);

	// Create the lines
	$c1 = new LinePlot($data1);
	//$c1->SetLineColor("red");
	$c2 = new LinePlot($data2);
	//$c2->SetLineColor("blue");
	$c3 = new LinePlot($data3);
	//$c3->SetLineColor("yellow");

	// ...and add it to the graph
	$graph->add($c1);
	$graph->add($c2);
	$graph->add($c3);

	//Set the graph title
	$graph->title->Set($datasP[0]["libelle"]);
	$graph->title->SetFont(FF_FONT1, FS_BOLD);
	
	//Set x-axis properties
	$graph->xaxis->title->Set("X");
	$graph->xaxis->SetTickLabels($x);
	$graph->xaxis->title->SetFont(FF_FONT1, FS_BOLD);

	//Set y-axis properties
	$graph->yaxis->title->Set("Y");
	$graph->yaxis->title->SetFont(FF_FONT1, FS_BOLD);
	
	// Set the img format
	$graph->SetImgFormat("jpeg", 90);

	// Save the graph
	$graph->Stroke("../design/img/" . $imgfile);
	
	return $imgfile;
}
?>
