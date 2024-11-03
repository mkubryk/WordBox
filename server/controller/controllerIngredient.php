<?php
require_once("model/ingredient.php");
require_once("controller/controllerObjet.php");
class controllerIngredient extends controllerObjet {
    
    protected static string $classe = "Ingredient";
	protected static string $identifiant = "numIngredient";
    protected static $champs = array(
        "nomIngredient" => ["text", "Nom de l'ingrédient"],
        "prixIngredient" => ["number", "Prix (€)"],
        "quantiteMin" => ["number", "Quantité minimale"],
        "stockI" => ["number", "Nombre en stock"],
        "poidsI" => ["number", "Poids à l'unité (gramme)"]
    );

    public static function displayCreationForm() {
        $title= "création ingredient";
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
        $selectGerant= Gerant::getSelect();
        include("view/debut.php");
        include("view/menu.php");
        include("view/formulaireCreation_bis.php");
        include("view/ingredient/formulaireCreation.php");
        include("view/fin.php");
    }

    public static function displayCreationFormIng(){
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
		$title = "création ".$classe;
		include("view/formulaireCreation_simple.php");
	}

    
}
?>