<?php
	function setError($error){
		header('HTTP/1.1 ' . $error);
		exit;
	}
	
	function badRequest(){
		setError("400");
	}
	
	function unauthorized(){
		setError("401");
	}
	
	function forbidden(){
		setError("403");
	}
	
	function notFound(){
		setError("404");
	}
	
	function laugth(){
		setError("418 I'm a teapot");
	}
	
	function serverError(){
		setError("500");
	}
	
	function notImplemented(){
		setError("501");
	}
	
	function badGateway(){
		setError("502");
	}
	
	function unavailable(){
		setError("503");
	}
	
	function error(){
		setError("520");
	}
?>
