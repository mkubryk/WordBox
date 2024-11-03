<?php
require_once("model/pizza.php");
require_once("controller/controllerObjet.php");
class controllerPizza extends controllerObjet {
    
    protected static string $classe = "Pizza";
	protected static string $identifiant = "numPizza";
    protected static $champs = array(
        "nomPizza" => ["text", "Nom de la pizza"],
        "statutPizza" => ["text", "Statut de la pizza"]
    );

    public static function displayCreationForm() {
        $title= "création pizza";
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
        $selectRecette= Recette::getSelect();
        include("view/debut.php");
        include("view/menu.php");
        include("view/formulaireCreation_bis.php");
        include("view/pizza/formulaireCreation.php");
        include("view/fin.php");
    }

}
?>