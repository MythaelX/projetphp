<div class="container-fluid">
	<div class="navbar-header">
		<a class="navbar-brand" target="_self" href="./" onclick="unsetSession();">Chen-co.corp</a>
	</div>
	<ul class="nav navbar-nav">
		<?php
			$page = $_SERVER["PHP_SELF"];
			$urls = explode("/", $page);
			$page = $urls[sizeOf($urls) - 1];
			
			echo "<li";
			if($page == "index.php" && !isset($_SESSION["show"]) && !isset($_SESSION["edit"])){
				echo " class='active'";
			}
			echo "><a target=\"_self\" href=\"./\" onclick=\"unsetSession();\">Accueil</a></li>\n";
			
			echo "\t\t<li";
			if($page == "new.php"){
				echo " class='active'";
			}
			echo "><a target=\"_self\" href=\"new.php?action=post\">Nouveau</a></li>\n";
		?>
	</ul>
</div>
