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
        $userName = $_GET["userName"];
        $mdp = $_GET["mdp"];
        
        $client = array("nomClient" => $nom, "prenomClient" => $prenom,  "userName" => $userName, "mdp" => $mdp);
        Client::create($client);
     }

     public static function update() {
        // Récupérer les données du formulaire
        $nom = $_GET["nomClient"];
        $prenom = $_GET["prenomClient"];
        $userName = $_GET["userName"];
        $mdp = $_GET["mdp"];

        
        $client = array("nomClient" => $nom, "prenomClient" => $prenom, "userName" => $userName, "mdp" => $mdp);
        var_dump($client);
        Client::update($client);

         }



     
}
?>

