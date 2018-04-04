<?php
	header("Content-Type: text/plain; charset=utf-8");
	header("Cache-control: no-store, no-cache, must-revalidate");
	header("Pragma: no-cache");

	$type = $_SERVER["REQUEST_METHOD"];
	$serverRequest = substr($_SERVER["PATH_INFO"], 1);
	$serverRequest = explode("/", $serverRequest);
	
	if($type == "PUT"){
		parse_str(file_get_contents("php://input"), $_PUT);
	} else if($type == "DELETE"){
		$_DELETE = $_GET;
	}
	
	function nextRes(){
		return array_shift($GLOBALS["serverRequest"]);
	}
?>
