<?php
require_once("model/recette.php");
require_once("controller/controllerObjet.php");
class controllerRecette extends controllerObjet {
    
    protected static string $classe = "Recette";
	protected static string $identifiant = "numRecette";
    protected static $champs = array(
        "nomRecette" => ["text", "Nom de la Recette"],
        "prixPizza" => ["number", "Prix (€)"],
        "enActu" => ["number", "Mettre la recette en actualité (mettre 1 et 0 sinon) " ]
    );
    
    public static function displayCreationForm() {
        $title= "création recette";
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
        $selectPatepizza= Patepizza::getSelect();
        include("view/debut.php");
        include("view/menu.php");
        include("view/formulaireCreation_bis.php");
        include("view/recette/formulaireCreation.php");
        include("view/fin.php");
    }

    public static function displayCreationFormPate() {
        $title= "création recette";
        $selectPatepizza= Patepizza::getSelect();
        include("view/recette/formulaireCreationFormBis.php");
    }

    public static function displayPizzas() {
        $title= "catalogue pizza";
        $classe = static::$classe;
        $lesPizzas= $classe::getAll();
        include("view/debut.php");
        include("catalogue_pizza.php");
        include("view/fin.php");
    }

    public static function ajout_pizza_panier (){
        if($_SESSION==NULL || isset($_SESSION["adminName"])) { 
            include("view/debut.php");
            include("ajout_refus.php");
            include("view/fin.php");
        }
        else {
            $idRecette = $_GET["identifiant"];
            Recette::ajout_pizza_panier($idRecette);
            self::displayPizzas();
        }
    }

}
?>