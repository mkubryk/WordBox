<?php
require_once("model/modePaiement.php");
require_once("controller/controllerObjet.php");
class controllerModePaiement extends controllerObjet {
    
    protected static string $classe = "Modepaiement";
	protected static string $identifiant = "numModeP";
    protected static $champs = array(
        "nomModeP" => ["text", "Nom du moyen de paiement"]
    );
}
?>