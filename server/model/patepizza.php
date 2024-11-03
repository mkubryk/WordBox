<?php 
require_once("objet.php");
class Patepizza extends objet{

	protected static string $classe = "Patepizza";
	protected static string $identifiant = "numPatePizza";
    protected int $numPatePizza;
    protected string $nomPatePizza;
    
     //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) à afficher dans le visuel
    protected static $tableauSelect = array("Patepizza", "nomPatePizza");
   
  
    public function __construct (int $numPatePizza= NULL,string $nomPatePizza= NULL){
        if(!is_null($numPatePizza)){
           $this->numPatePizza=$numPatePizza;
           $this->nomPatePizza=$nomPatePizza;
        }
    }
    public function __toString() : string{
        $chaine = "PatePizza $this->numPatePizza ( $this->nomPatePizza)";
        return $chaine;
    }

    public static function getLesMP($id){
		$classeRecuperee=static::$classe;
		$identifiant = static::$identifiant;
		$requetePreparee = "SELECT DISTINCT numMP,nomMP,poids,numGerant,stockMP,quantiteMin FROM $classeRecuperee NATURAL JOIN  Compo_pate NATURAL JOIN Matiere_premiere WHERE $identifiant = :id_tag;";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		$tags = array("id_tag"=> $id);
		try {
			$resultat->execute($tags);
			$resultat->setFetchmode(PDO::FETCH_CLASS,"Matiere_premiere");
			$element =$resultat->fetchAll(PDO::FETCH_CLASS,"Matiere_premiere");
			return $element;
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>