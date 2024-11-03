<?php 

require_once("controller/controllerGerant.php");
require_once("objet.php");
class Gerant extends objet{
	protected static string $classe = "Gerant";
	protected static string $identifiant = "numGerant";
    protected int $numGerant;
    protected string $nomGerant;
    protected ?string $emailGerant;
    protected ?string $adminName;
    protected ?string $mdp;
     //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) à afficher dans le visuel
    protected static $tableauSelect = array("Gerant", "adminName");
  
    public function __construct (int $numGerant= NULL,string $nomGerant= NULL,string $emailGerant= NULL,string $adminName= NULL,string $mdp= NULL){
        if(!is_null($numGerant)){
           $this->numGerant=$numGerant;
           $this->nomGerant=$nomGerant;
           $this->emailGerant=$emailGerant;
           $this->adminName=$adminName;
           $this->mdp=$mdp;
        }
    }
    public function __toString() : string{
        $chaine = "Gérant $this->numGerant ( $this->nomGerant, $this->emailGerant, $this->adminName,$this->mdp)";
        return $chaine;
    }

    public static function isAdmin() {return true;}

    public static function checkMDP($l, $m) {
        $requetePreparee = "SELECT * FROM Gerant WHERE adminName = :adminName AND mdp = :mdp";
        $resultat = connexion::pdo()->prepare($requetePreparee);
        
        try {
            $resultat->execute(array(':adminName' => $l, ':mdp' => $m));
            $resultat->setFetchmode(PDO::FETCH_CLASS, "Gerant");
            $leGerant = $resultat->fetch();
            
            return ($leGerant != null);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    

    public static function connect($adminName, $mdp) {
        $classe = static::$classe;
        if ($classe::checkMDP($adminName, $mdp)) {
            $_SESSION["adminName"] = $adminName;
            $_SESSION["mdp"] = $mdp;
            $client = $classe::getOne($adminName);
            $_SESSION["isAdmin"] = $classe::isAdmin();
            controllerGerant::displayStart();
        } else {
            include("connexion.php");
        }
    }
}
?>