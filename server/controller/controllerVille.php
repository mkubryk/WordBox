<?php
require_once("model/ville.php");
require_once("controller/controllerObjet.php");
class controllerVille extends controllerObjet {
    
    protected static string $classe = "Ville";
	protected static string $identifiant = "numVille";

    protected static $champs = array(
        "nomVille" => ["text", "Ville"],
        "codePostal" => ["number", "Code postal"]
    );
}
?>