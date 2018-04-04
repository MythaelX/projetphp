<?php
	class Head_Creator{
		private $_head;
		private $_path;
		
		public function __construct($path, $session = 1){
			$this->_head = "";
			$this->_path = "./";
			
			if($session){
				$this->startSession();
			}
			
			$this->_head = "<!DOCTYPE html>\n<html>\n\t<head>\n"
						 . "\t\t<base href=\"" . $path . "\" target=\"_blank\" />\n"
						 . "\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">\n";
		}
		
		public function show(){
			echo $this->_head . "\t</head>\n";
		}
		
		public function getPath(){
			return $this->_path;
		}
		
		public function head_charset($charset){
			$this->_head .= "\t\t<meta charset=\"$charset\" />\n";
		}
		
		public function head_title($title){
			$this->_head .= "\t\t<title>$title</title>\n";
		}
		
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
		
		public function head_icon($logo){
			$this->_head .= "\t\t<link rel=\"icon\" type=\"image/png\" href=\"" . $this->_path . "$logo\" />\n";
		}
		
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
		
		public function head_keywords($keywords, $lang = "fr"){
			$this->_head .= "\t\t<meta name=\"keywords\" lang=\"$lang\" content=\"$keywords\" />\n";
		}
		
		public function head_description($description){
			$this->_head .= "\t\t<meta name=\"description\" content=\"$description\" />\n";
		}
		
		public function head_language($lang){
			$this->_head .= "\t\t<meta http-equiv=\"Content-Language\" content=\"$lang\" />\n";
		}
		
		public function head_author($author, $lang = "fr"){
			$this->_head .= "\t\t<meta name=\"author\" lang=\"$lang\" content=\"$author\" />\n";
		}
		
		private function startSession(){
			session_start();
		}
	}
?>
