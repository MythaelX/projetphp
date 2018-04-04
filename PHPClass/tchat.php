<?php
	require_once("getter.php");
	require_once("bdd.php");
	
	$bdd = new Bdd("mysql", "127.0.0.1:3306", "chatbottest", "mathias", "chipie");
	
	$res = nextRes();
	
	if($res == "start"){
		echo "Bonjour, je suis ici pour vous conseiller. Quelle est votre question ?";
	} else if($res == "talk"){
		$text = $_POST["text"];
		
		$reps = $bdd->select("keywords", "*");
		
		$percent = 0;
		$prec = -1;
		$answer = "";
		$out = "";
		$id = 0;
		$idC = 0;
		
		foreach($reps as $key => $rep){
			$keywords = explode("|", $rep["keywords"]);
		
			$i = 0;
			foreach($keywords as $keyword){
				$i += mb_substr_count(strtolower($text), strtolower($keyword));
			}
			$percent = $i / sizeOf($keywords);
			
			if($precent >= 1){
				if($answer == ""){
					$answer .= $rep["answers"];
				} else {
					$answer .= " " . $rep["answers"];
				}
			}
		
			if($prec < $percent){
				$prec = $percent;
				$out = $rep["answers"];
				$idC = $id;
			}
			
			$id++;
		}
		
		$percent = $prec;
		
		if($percent < 0.5 && $answer == ""){
			echo "Je n'ai pas compris votre question. Pourriez-vous la reformuler ?";
		} else {
			echo $answer . " " . $out;
		}
		
		//echo "Votre question est : \"" . $text . "\" et $rep";
	}
?>
