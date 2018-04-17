<!-- nom du site -->
<a class="navbar-brand" target="_self" href="./" onclick="unsetSession();">Chen-co.corp</a>
<!-- liens -->
<ul class="navbar-nav">
	<?php
		/* Vérification de la page actuelle pour l'attribut active du menu */
		$page = $_SERVER["PHP_SELF"];
		$urls = explode("/", $page);
		$page = $urls[sizeOf($urls) - 1];

		echo "<li class='nav-item";
		if($page == "index.php" && !isset($_SESSION["show"]) && !isset($_SESSION["edit"])){
			echo " active";
		}
		echo "'><a class='nav-link' target=\"_self\" href=\"./\" onclick=\"unsetSession();\">Accueil</a></li>\n";

		echo "\t\t<li class='nav-item";
		if($page == "new.php"){
			echo " active";
		}
		echo "'><a class='nav-link' target=\"_self\" href=\"new.php?action=post\">Nouveau</a></li>\n";
	?>
</ul>
