<?php
	$rep = $bdd->select("parametre", "*");
	
	echo "bouh<pre>";
	print_r($rep);
	echo "</pre>";
?>
