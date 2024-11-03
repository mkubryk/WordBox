<?php
require_once("model/commande.php");
require_once("model/client.php");
require_once("controller/controllerObjet.php");
class controllerCommande extends controllerObjet {
    
    protected static string $classe = "Commande";
	protected static string $identifiant = "numCommande";
    protected static $champs = array(
        "dateCommande" => ["date", "Date de la commande"],
        "statutCommande" => ["text", "Statut de la commande"]
    );
    
    public static function displayCreationForm() {
        $title= "création commande";
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
        $selectModepaiement = Modepaiement::getSelect();
        $selectClient = Client::getSelect();
        include("view/debut.php");
        include("view/menu.php");
        include("view/formulaireCreation_bis.php");
        include("view/commande/formulaireCreation.php");
        include("view/fin.php");
    }

    public static function displayBasket(){
        $title= "panier client";
        if($_SESSION==NULL || isset($_SESSION["adminName"])) { 
            include("view/debut.php"); 
            include("panier_vide.php");
           include("view/fin.php");
       }
       else{
            $numCmde = $_SESSION["numCommande"];
            $commande = Commande::getOne($numCmde);
            $panier = $commande->remplirPanier();
            include("view/debut.php");
            include("panier.php");
            include("view/fin.php");
       }
    }
    
    public static function displayPaiement(){
        $title= "paiement client";
        $numCmde = $_SESSION["numCommande"];
        $commande = Commande::getOne($numCmde);
        $client = Client::getOne($commande->get("numClient"));
        include("view/debut.php");
        include("paiement.php");
        include("view/fin.php");
        
    }
}
?>