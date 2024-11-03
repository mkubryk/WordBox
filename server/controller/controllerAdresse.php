<?php
require_once("model/adresse.php");
require_once("controller/controllerObjet.php");
class controllerAdresse extends controllerObjet {
    
    protected static string $classe = "Adresse";
	protected static string $identifiant = "numAdresse";
    protected static $champs = array(
        "nomAdr" => ["text", "adresse"],
        "coordonneeX" => ["number", "coordonnée x"],
        "coordonneeY" => ["number", "coordonnée y"]
    );

    public static function displayCreationForm() {
        $title= "création adresse";
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
        $selectVille = Ville::getSelect();
        var_dump($selectVille);
        include("view/debut.php");
        include("view/menu.php");
        include("view/formulaireCreation_bis.php");
        include("view/adresse/formulaireCreation.php");
        include("view/fin.php");
    }
}
?>