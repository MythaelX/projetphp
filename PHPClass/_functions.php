<?php

/****************************************************************/
/*																*/
/*			File : _functions.php								*/
/*				Created by Mathias CABIOCH-DELALANDE			*/
/*					Last modification : 21/04/2018				*/
/*																*/
/*				Authorization : use only						*/
/*																*/
/****************************************************************/

	/* Function that can print some of all types of variables like string, object or array */
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
	
	/* Function that replace something by something else in a string or an array */
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
