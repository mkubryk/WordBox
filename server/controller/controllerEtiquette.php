<?php
require_once("model/etiquette.php");
require_once("controller/controllerObjet.php");
class controllerEtiquette extends controllerObjet {
    
    protected static string $classe = "Etiquette";
	protected static string $identifiant = "codeBarre";
    protected static $champs = array(
        "codeBarre" => ["text", "Code barre"],
        "dateReception" => ["date", "Date de réception"]
    );
    
    public static function displayCreationForm() {
        $title= "création etiquette";
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
        $selectCommande= Commande::getSelect();
        $selectPizza= Pizza::getSelect();
        include("view/debut.php");
        include("view/menu.php");
        include("view/formulaireCreation_bis.php");
        include("view/etiquette/formulaireCreation.php");
        include("view/fin.php");
    }
}
?>