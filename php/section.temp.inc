<?php
	$rep = $bdd->select("parametre", "*");
	
	echo "<pre>";
	print_r($rep);
	echo "</pre>";
?>
