<?php
require_once("model/produit.php");
require_once("controller/controllerObjet.php");
class controllerProduit extends controllerObjet {
    
    protected static string $classe = "Produit";
	protected static string $identifiant = "numProduit";
    protected static $champs = array(
        "nomProduit" => ["text", "Nom du produit"],
        "prixProduit" => ["number", "Prix (€)"],
        "quantiteMin" => ["number", "Quantité minimale"],
        "stockP" => ["number", "Nombre en stock"],
        "typeProduit" => ["text", "Nom du type du produit (Boisson ou Dessert)"]
    );
    
    public static function displayCreationForm() {
        $title= "création produit";
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
        $selectGerant= Gerant::getSelect();
        include("view/debut.php");
        include("view/menu.php");
        include("view/formulaireCreation_bis.php");
        include("view/produit/formulaireCreation.php");
        include("view/fin.php");
    }

    
    public static function displayDrinks() {
        $title= "catalogue boisson";
        $drinks= Produit::getProducts("Boisson");
        include("view/debut.php");
        include("catalogue_boisson.php");
        include("view/fin.php");
    }

    public static function displayDeserts() {
        $title= "catalogue dessert";
        $deserts= Produit::getProducts("Dessert");
        include("view/debut.php");
        include("catalogue_dessert.php");
        include("view/fin.php");
    }

    public static function ajout_produit_panier () {
        if($_SESSION==NULL || isset($_SESSION["adminName"])) { 
            include("view/debut.php");
            include("ajout_refus.php");
            include("view/fin.php");
        }
        else {
            $idProduit = $_GET["identifiant"];
            Produit::ajout_produit_panier($idProduit);
            $type = Produit::getOne($idProduit)->get("typeProduit");
            if ($type == "Boisson") {self::displayDrinks();}
            elseif ($type == "Dessert") {self::displayDeserts();}
        }
    }

}

?>