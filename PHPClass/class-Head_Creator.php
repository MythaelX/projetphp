<?php

/****************************************************************/
/*																*/
/*			File : class-Head_Creator.php						*/
/*				Created by Mathias CABIOCH-DELALANDE			*/
/*					Last modification : 21/04/2018				*/
/*																*/
/*				Authorization : use only						*/
/*																*/
/****************************************************************/

	class Head_Creator{
		private $_head;
		private $_path;
		
		/* Class constructor */
		public function __construct($path, $session = 1){
			$this->_head = "";
			$this->_path = "./";
			
			/* Start the PHP session system */
			if($session){
				$this->startSession();
			}
			
			/* Create the beginning part of the code */
			$this->_head = "<!DOCTYPE html>\n<html>\n\t<head>\n"
						 . "\t\t<base href=\"" . $path . "\" target=\"_blank\" />\n"
						 . "\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
		}
		
		/* Show the head tag */
		public function show(){
			echo $this->_head;
		}
		
		/* Return the head code */
		public function get(){
			return $this->_head;
		}
		
		/* Recovery of the saved path */
		public function getPath(){
			return $this->_path;
		}
		
		/* Definition of the charset */
		public function head_charset($charset){
			$this->_head .= "\t\t<meta charset=\"$charset\" />\n";
		}
		
		/* Definition of the page title */
		public function head_title($title){
			$this->_head .= "\t\t<title>$title</title>\n";
		}
		
		/* Definition of a style tag to a stylesheet */
		public function head_style($style, $media = "all"){
			$this->_head .= "\t\t<link rel=\"";
			
			if(strpos($style, "less")){
				$this->_head .= "stylesheet/less";
			} else {
				$this->_head .= "stylesheet";
			}
			
			$this->_head .= "\" type=\"text/css\" media=\"$media\" href=\"";
			
			if(strpos($style, "http") === false){
				$this->_head .= $this->_path;
			}
			
			$this->_head .= "$style\" />\n";
		}
		
		/* Definition of the page icon */
		public function head_icon($logo){
			$this->_head .= "\t\t<link rel=\"icon\" type=\"image/png\" href=\"" . $this->_path . "$logo\" />\n";
		}
		
		/* Definition of a script tag to a javaScript file */
		public function head_script($script, $async=false, $defer=true){
			$this->_head .= "\t\t<script src=\"";
			
			if(strpos($script, "http") === false){
				$this->_head .= $this->_path;
			}
			
			$this->_head .= "$script\" type=\"text/javascript\" ";
			
			if($async){
				$this->_head .= "async";
			}
			
			$this->_head .= " ";
			
			if($defer){
				$this->_head .= "defer";
			}
			
			$this->_head .= "></script>\n";
		}
		
		/* Definition of a JavaScript tag with JS source code */
		public function head_ownScript($script, $async=false, $defer=true){
			$this->_head .= "\t\t<script type=\"text/javascript\" ";
			
			if($async){
				$this->_head .= "async";
			}
			
			$this->_head .= " ";
			
			if($defer){
				$this->_head .= "defer";
			}
			
			$this->_head .= ">$script</script>\n";
		}
		
		/* Definition of the page keywords */
		public function head_keywords($keywords, $lang = "fr"){
			$this->_head .= "\t\t<meta name=\"keywords\" lang=\"$lang\" content=\"$keywords\" />\n";
		}
		
		/* Definition of the page description */
		public function head_description($description){
			$this->_head .= "\t\t<meta name=\"description\" content=\"$description\" />\n";
		}
		
		/* Definition of the page language */
		public function head_language($lang){
			$this->_head .= "\t\t<meta http-equiv=\"Content-Language\" content=\"$lang\" />\n";
		}
		
		/* Definition of the page author */
		public function head_author($author, $lang = "fr"){
			$this->_head .= "\t\t<meta name=\"author\" lang=\"$lang\" content=\"$author\" />\n";
		}
		
		/* Start the PHP session system */
		private function startSession(){
			session_start();
		}
	}
?>
