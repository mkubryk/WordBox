<?php
require_once("model/patepizza.php");
require_once("controller/controllerObjet.php");
class controllerPatePizza extends controllerObjet {
    
    protected static string $classe = "Patepizza";
	protected static string $identifiant = "numPatePizza";
    protected static $champs = array(
        "nomPatePizza" => ["text", "Nom de la pâte"]
    );
}
?>