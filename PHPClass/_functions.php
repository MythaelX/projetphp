<?php
	function print_all($in){
		echo "<pre>";
		
		if(gettype($in) === "array"){
			print_r($in);
		} else if(gettype($in) === "object" || gettype($in) === "ressource"){
			var_dump($in);
		} else {
			echo $in;
		}
		
		echo "</pre>";
	}
	
	function replace_all($from, $to, $in){
		if(gettype($in) === "string"){
			return implode($to, explode($from, $in));
		} else if(gettype($in) === "array"){
			foreach($in as $key => $val){
				$out[$key] = replace_all($from, $to, $val);
			}
			
			return $out;
		}
	}
?>
