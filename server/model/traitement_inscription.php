<?php
require_once("ville.php");
require_once("adresse.php");
require_once("client.php");
require_once("ingredient.php");
require_once("matiere_premiere.php");
require_once("compose_recette.php");

class Traitement_inscription {

    protected static string $classe = "Traitement_inscription";

    public static function inscrire() {
        // Récupérer les données du formulaire
        $nom = $_GET["nomClient"];
        $prenom = $_GET["prenomClient"];
        $telephone = $_GET["numTelClient"];
        $userName = $_GET["userName"];
        $mdp = $_GET["mdp"];
        $numCarte = $_GET["numCarte"];
        $CVV = $_GET["CVV"];
        $dateExpire = $_GET["dateExpire"];
        $nomVille = $_GET["nomVille"];
        $codePostal = $_GET["codePostal"];
        $adresse = $_GET["nomAdr"];
        $x=rand(1,100);
        $y=rand(1,100);


        $ville = array("nomVille" => $nomVille, "codePostal" => $codePostal);
        Ville::create($ville);

        $numVille = connexion::pdo()->lastInsertId();

        $adr = array("nomAdr" => $adresse, "coordonneeX" => $x, "coordonneeY" => $y, "numVille" => $numVille);
        Adresse::create($adr);

        $idAdr = connexion::pdo()->lastInsertId();

        $client = array("numCarte" => $numCarte, "dateExpire" => $dateExpire, "CVV" => $CVV, "nomClient" => $nom, "prenomClient" => $prenom, "numTelClient" => $telephone, "userName" => $userName, "mdp" => $mdp, "numAdresse" => $idAdr);
        Client::create($client);
     }

     public static function update() {
        // Récupérer les données du formulaire
        $nom = $_GET["nomClient"];
        $telephone = $_GET["numTelClient"];
        $numCarte = $_GET["numCarte"];
        $CVV = $_GET["CVV"];
        $dateExpire = $_GET["dateExpire"];
        $nomVille = $_GET["nomVille"];
        $codePostal = $_GET["codePostal"];
        $nomAdresse = $_GET["nomAdr"];
        $x=rand(1,100);
        $y=rand(1,100);

        $ville = array("numVille" => $numVille, "nomVille" => $nomVille, "codePostal" => $codePostal);
        var_dump($ville);
        Ville::update($ville);

        $adr = array("numAdresse"=> $numAdr ,"nomAdr" => $nomAdresse, "coordonneeX" => $x, "coordonneeY" => $y);
        var_dump($adr);
        Adresse::update($adr);

        $client = array("numCarte" => $numCarte, "dateExpire" => $dateExpire, "CVV" => $CVV, "nomClient" => $nom, "prenomClient" => $prenom, "numTelClient" => $telephone, "userName" => $userName, "mdp" => $mdp);
        var_dump($client);
        Client::update($client);

        $panier = array ("numModeP" => 3 , "numClient" => $idClient);
        Commande::create($panier);
        $idCommande = connexion::pdo()->lastInsertId();
        $_SESSION["numCommande"] = $idCommande;

        $donnees = array("numTel"=> $client_>get("numTelClient") , "statutLivraison"=> "non livrée", "numAdresse" =>$numAdr);
        $champs = implode(", ", array_keys($donnees));
        $tags = ":" . implode(", :", array_keys($donnees));
        $requete = "INSERT INTO Livraison ($champs) VALUES ($tags)";
        echo "$requete";
		$pdo = connexion::pdo();
        try {
            $requetePreparee = $pdo->prepare($requete);
            $requetePreparee->execute($donnees);
            echo "Insertion réussie !";
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            echo "<br>Requête SQL : $requete";
            echo "<br>Données : " . print_r($donnees, true);
        }

        $idLivraison = connexion::pdo()->lastInsertId();
        Commande::update(array("numCommande"=>  $_SESSION["numCommande"], "statutCommande" => "En préparation", "numLivraison" => $idLivraison));
     }



     public static function ajout_recette() {
        // Récupérer les données du formulaire
        if(isset($_GET["nomRecette"]))
        $nomRecette = $_GET["nomRecette"];
        if(isset($_GET["cheminImage"]))
        $cheminImage = $_GET["cheminImage"];
        if(isset($_GET["prixPizza"]))
        $prixPizza = $_GET["prixPizza"];

        if (isset($_GET["new_pate"])){ 
            $nouvellePate = $_GET["new_pate"];

            if ($nouvellePate == "oui") {
                if (isset( $_GET["nomPatePizza"])){
                    $nomPate =  $_GET["nomPatePizza"];
                    $pate = array( "nomPatePizza" =>  $_GET["nomPatePizza"]);
                    Pate::create($pate);
                    $idPate = connexion::pdo()->lastInsertId();
                    $recette = array("nomRecette" => $nomRecette, "cheminImage" => $cheminImage, "prixPizza" => $prixPizza, "numPatePizza" => $idPate);
                    Recette::create($recette);
                }
            }
            elseif ($nouvellePate == "non") {
                // Ajout de la recette
                $recette = array("nomRecette" => $nomRecette, "cheminImage" => $cheminImage, "prixPizza" => $prixPizza);
                Recette::create($recette);
            }

            $idRecette = connexion::pdo()->lastInsertId();
        }

        
        if(isset($_GET["new_ingredient"])){
            $nbNewIng = $_GET["new_ingredient"];
        // Ajout des nouveaux ingrédients
        for ($i = 0; $i < $nbNewIng; $i++) {
            $ingredient = array(
                "nomIngredient" => $_GET["nomIngredient"],
                "prixIngredient" =>$_GET["prixIngredient"] ,
                "quantiteMin" =>$_GET["quantiteMin"] ,
                "stockI" => $_GET["stockI"],
                "poidsI" => $_GET["poidsI"]
                );
            Ingredient::create($ingredient);
            $idIngredient = connexion::pdo()->lastInsertId();
            $compose_recette = array("numRecette" => $idRecette, "numIngredient" => $idIngredient);
            Compose_recette::create($compose_recette);
            }
        }

        if(isset($_GET["ingredients"])){
            $nbIng  = $_GET["ingredients"];
            // Ajout des liaisons entre les ingredients existants et la recette
            for ($i = 0; $i < $nbIng; $i++) {
                $idIngredient = $_GET["numIngredient"];
                $compose_recette = array("numRecette" => $idRecette, "numIngredient" => $idIngredient);
                Compose_recette::create($compose_recette);
            }
        }
     }
}
?>

