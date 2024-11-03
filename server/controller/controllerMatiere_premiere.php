<?php
require_once("model/matiere_premiere.php");
require_once("controller/controllerObjet.php");
class controllerMatiere_premiere extends controllerObjet {
    
    protected static string $classe = "Matiere_premiere";
	protected static string $identifiant = "numMP";
    protected static $champs = array(
        "nomMP" => ["text", "Nom de la matière première"],
        "quantiteMin" => ["number", "Quantité minimale"],
        "stockMP" => ["number", "Nombre en stock"],
        "poids" => ["number", "Poids à l'unité (gramme)"]
    );
    
    public static function displayCreationForm() {
        $title= "création matiere premiere";
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
        $selectGerant= Gerant::getSelect();
        include("view/debut.php");
        include("view/menu.php");
        include("view/formulaireCreation_bis.php");
        include("view/matiere_premiere/formulaireCreation.php");
        include("view/fin.php");
    }
}
?>