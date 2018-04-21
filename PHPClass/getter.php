<?php

/****************************************************************/
/*																*/
/*			File : getter.php									*/
/*				Created by Mathias CABIOCH-DELALANDE			*/
/*					Last modification : 21/04/2018				*/
/*																*/
/*				Authorization : use only						*/
/*																*/
/****************************************************************/

	/* Définition des headers nécessaires à la récupération des informations */
		header("Content-Type: text/plain; charset=utf-8");
		header("Cache-control: no-store, no-cache, must-revalidate");
		header("Pragma: no-cache");
	/*************************************************************************/

	$type = $_SERVER["REQUEST_METHOD"];							//Récupération du type de la requête
	$serverRequest = substr($_SERVER["PATH_INFO"], 1);			//Récupération des arguments passés à la page
	$serverRequest = explode("/", $serverRequest);				//Mise sous forme de tableau des arguments
	
	if($type == "PUT"){
		parse_str(file_get_contents("php://input"), $_PUT);		//En cas d'envoie PUT, création du tableau $_PUT
	} else if($type == "DELETE"){
		$_DELETE = $_GET;										//En cas d'envoie DELETE, création du tableau $_DELETE
	}
	
	/* Fonction qui renvoie la ressource suivante dans le tableau des arguments */
	function nextRes(){
		return array_shift($GLOBALS["serverRequest"]);
	}
?>
