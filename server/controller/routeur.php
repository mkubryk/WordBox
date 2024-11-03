<?php

// Insertion de la session
require_once("model/session.php");

// Connexion
require_once("config/connexion.php");
connexion::connect();

// Actions et objets possibles
$actions = ["update_paiement", "displayPersonnalise","update","displayCreationFormPate","displayCreationForm_simple","displayCreationFormBis","continue","displayStart","displayStat","displayCreationRecipe","displayAll", "displayOne", "delete", "create", "displayCreationForm", "displayConnectionForm", "connect", "disconnect", "inscrire","displayUpdateForm"];
$objets = ["objet", "Client", "Gerant", "Mot_sympa", "Traitement_inscription"];

// Valeurs par défaut
$objet = "objet";
$action = "displayStart";

// Test si un objet correct est passé dans l'URL
if (isset($_GET["objet"]) && in_array($_GET["objet"], $objets)) {
    $objet = $_GET["objet"];
}

// Test si une action correcte est passée dans l'URL
if (isset($_GET["action"]) && in_array($_GET["action"], $actions)) {
    $action = $_GET["action"];
}

// Vérifier si aucun client ou gérant n'est connecté et si l'action nécessite une connexion
if (!session::clientConnected() && !session::adminConnected() && in_array($action, ["create", "disconnect"])) {
    $objet = "Client";
    $action = "displayConnectionForm";
}

// Construction du contrôleur
$controller = "controller" . ucfirst($objet);

// Insertion du contrôleur
require_once("$controller.php");

// Appel des méthodes du contrôleur
$controller::$action();
?>
