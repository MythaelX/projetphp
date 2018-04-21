<?php

/****************************************************************/
/*																*/
/*			File : errors.php									*/
/*				Created by Mathias CABIOCH-DELALANDE			*/
/*					Last modification : 21/04/2018				*/
/*																*/
/*				Authorization : use only						*/
/*																*/
/****************************************************************/

	/* Renvoie une erreur et arrête le script */
	function setError($error){
		header('HTTP/1.1 ' . $error);
		exit;
	}
	
	/* Mauvaise requête */
	function badRequest(){
		setError("400");
	}
	
	/* Non authorisé */
	function unauthorized(){
		setError("401");
	}
	
	/* Accès interdit */
	function forbidden(){
		setError("403");
	}
	
	/* Page non trouvé */
	function notFound(){
		setError("404");
	}
	
	/* Je suis une théière */
	function laugth(){
		setError("418 I'm a teapot");
	}
	
	/* Erreur du serveur */
	function serverError(){
		setError("500");
	}
	
	/* Demande non implémentée */
	function notImplemented(){
		setError("501");
	}
	
	/* Mauvais chemin */
	function badGateway(){
		setError("502");
	}
	
	/* Service indisponible */
	function unavailable(){
		setError("503");
	}
	
	/* Erreur */
	function error(){
		setError("520");
	}
?>
