<?php
require_once("model/allergene.php");
require_once("controller/controllerObjet.php");
class controllerAllergene extends controllerObjet {
    
    protected static string $classe = "Allergene";
	protected static string $identifiant = "numAll";
    protected static $champs = array(
        "nomAll" => ["text", "nom de l'allergène"]
    );
}
?>