<?php 
require_once("model/stat.php");

class controllerStatistique {

	public static function displayStat(){
		include("view/debut.php");
		include("statistique.php");
		include("view/fin.php");
	}
}
?>