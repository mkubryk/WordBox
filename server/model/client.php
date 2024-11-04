<?php
require_once("controller/controllerClient.php");
require_once("commande.php");
require_once("objet.php");
class Client extends objet {
    protected static string $classe ="Client";
    protected static string $identifiant = "userName";
    
    protected ?string $nomClient;
    protected ?string $prenomClient;
    protected ?string $numTelClient;
    protected ?string $mdp;
    protected ?string $userName;
    
     //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) Ã  afficher dans le visuel
    protected static $tableauSelect = array("Client", "userName");

    public function __construct (string $nomClient=null,string $prenomClient=null,string $mdp= NULL,string $userName= NULL){
        if(!is_null($userName)){
            $this->nomClient =$nomClient;
            $this->prenomClient=$prenomClient;
            $this->mdp =$mdp;
            $this->userName = $userName;
        }
    }

    public function __toString(){
		$chaine = "Client $this->userName ($this->nomClient,$this->prenomClient,$this->numTelClient,$this->mel,$this->mdp)";
		return $chaine;
	}
    
    public static function checkMDP($un, $m) {
        $requetePreparee = "SELECT * FROM Client WHERE userName= '$un' AND mdp='$m'";
        $resultat = connexion::pdo()->prepare($requetePreparee);
        try {
            $resultat->execute();
            $resultat->setFetchmode(PDO::FETCH_CLASS, "Client");
            $leClient = $resultat->fetch();
            return ($leClient != null);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getClient ($login) {
        $classe = static::$classe;
        $requetePreparee = "SELECT * FROM $classe WHERE userName = :login;";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			$resultat->execute(array(':login' => $login));
			$resultat->setFetchmode(PDO::FETCH_CLASS, $classe);
			$element = $resultat->fetch();
            return $element;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
    }


    public static function connect($login,$mdp) {
        $classe = static::$classe;
        if ($classe::checkMDP($login, $mdp)) {
            $idClient = static::getClient($login)->get("numClient");
            $_SESSION["userName"] = $login;
            $_SESSION["mdp"] = $mdp;
            controllerClient::displayStart();
        } else {
           include("connexion.php");
        }
    }
    
    

    
}
?>