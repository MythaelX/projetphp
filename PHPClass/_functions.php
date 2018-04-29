<?php

/****************************************************************/
/*																*/
/*			File : _functions.php								*/
/*				Created by Mathias CABIOCH-DELALANDE			*/
/*					Last modification : 29/04/2018				*/
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
	
	/* Function that return all the content of a folder */
	function get_all_in($folder){
		$index = 0;
		
		$dir = opendir($folder);
		while(($file = readdir($dir)) !== false){
			$files[$index++] = $file;
		}
		closedir($dir);
		
		return $files;
	}
	
	/* Function that return all the files of a folder */
	function get_all_files_in($folder){
		$index = 0;
		$temp = get_all_in($folder);
		
		for($i = 0; $i < sizeOf($temp); ++$i){
			if(!is_dir($folder . $temp[$i])){
				$files[$index++] = $temp[$i];
			}
		}
		
		return $files;
	}
	
	/* Function that return all the folders of a folder */
	function get_all_folders_in($folder){
		$index = 0;
		$temp = get_all_in($folder);
		
		for($i = 0; $i < sizeOf($temp); ++$i){
			if(is_dir($folder . $temp[$i])){
				$files[$index++] = $temp[$i];
			}
		}
		
		return $files;
	}
?>
