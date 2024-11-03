<?php
require_once("model/commande.php");
require_once("model/client.php");
require_once("controllerPatepizza.php");
require_once("model/traitement_inscription.php");

class controllerTraitement_inscription {
    protected static string $classe = "Traitement_inscription";


    public static function inscrire() {
        $classe = static::$classe;
        $classe::inscrire();
        include_once("connexion.php");
    }

    public static function update_paiement(){
        $numCmde = $_SESSION["numCommande"];
        $commande = Commande::getOne($numCmde);
        $client = Client::getOne($commande->get("numClient"));
        $numAdr = $client->get("numAdresse");
        $adresse = Adresse::getOne($numAdr);
        $numVille = $adresse->get("numVille");
        $ville = Ville::getOne($numVille);
        $classe = static::$classe;
        include_once("view/debut.php");
        include_once("paiement.php");
        include_once("view/fin.php");
	}

    public static function update(){
       // Traitement_inscription::update();
       include_once("validPaiement.php");
    }


    public static function continue(){
        if(isset($_GET["nomRecette"])) {
            $nomRecette = $_GET["nomRecette"];
            if(isset($_GET["cheminImage"]))
                $cheminImage = $_GET["cheminImage"];
            if(isset($_GET["prixPizza"]))
                $prixPizza = $_GET["prixPizza"];
            if (isset($_GET["new_pate"])){
                $nouvellePate = $_GET["new_pate"];
                if ($nouvellePate == "oui") {
                    $nomPate = $_GET["nomPatePizza"];
                }
                else {
                    $numPate = $_GET["numPatePizza"];
                }
                if(isset($_GET["new_ingredient"]))
                    $nbNewIng = $_GET["new_ingredient"];
                if(isset($_GET["ingredients"])) 
                    $nbIng  = $_GET["ingredients"];
                $grpRecette= array ("nomRecette" => $nomRecette, "cheminImage" => $cheminImage, "prixPizza" => $prixPizza,
                "new_pate" => $new_pate, "new_ingredient"=> $nbNewIng, "ingredients"=> $nbIng);
                $lesIngExist = array();
                if (isset($_GET['numIngredient'])) {
                    $numIngredients = $_GET['numIngredient'];
                    if (is_array($numIngredients)) {
                        foreach ($numIngredients as $numeroIngredient) {
                            array_push($lesIngExist, $numeroIngredient);
                        }
                    } else {
                        array_push($lesIngExist, $numIngredients);
                    }
                }
            }
        }
        
         
        $step = $_GET["step"];
        include("view/debut.php");
        include("creationRecette.php");
        include("view/fin.php");
    }
    /*
    public static function ajout_recette() {
        $classe = static::$classe;
        if(isset($_GET["step"] && $_GET["step"]=="final")) {
            $classe::ajout_recette();
        }
        //include("creationRecette.php");
        echo "insertion réalisée ?";
    }*/
}
?>



