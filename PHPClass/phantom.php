<?php
	function phantomRun($script, $args = "", $path = "./"){
		$phantom = "./PHPClass/phantomjs";
		$out = false;
		
		try{
			$cmd = $path . $phantom;
			$cmd .= ' ';
			$cmd .= $path . $script;
			if($args !== ""){
				$cmd .= ' ' . $args;
			}
			
			exec($cmd . ' 2>&1', $out);
			
			return $out;
		} finally {}
		
		return false;
	}
?>
