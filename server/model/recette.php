<?php 
require_once("model/commande_pizza.php");  
require_once("model/patepizza.php");  
require_once("objet.php");

class Recette extends objet{
    
	protected static string $classe = "Recette";
	protected static string $identifiant = "numRecette";
    protected int $numRecette;
    protected string $nomRecette;
    protected float $prixPizza;
    protected int $numPatePizza;
    protected ?string $cheminImage;
	protected ?int  $enActu = 0;
   
     //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) à afficher dans le visuel
    protected static $tableauSelect = array("Recette", "nomRecette");
  
    public function __construct (int $numRecette= NULL,string $nomRecette= NULL, float $prixPizza=NULL, int $numPatePizza= NULL,string $cheminImage=NULL){
        if(!is_null($numRecette)){
           $this->numRecette=$numRecette;
           $this->nomRecette=$nomRecette;
           $this->prixPizza=$prixPizza;
           $this->numPatePizza=$numPatePizza;
           $this->cheminImage= $cheminImage;
        }
    }
    public function __toString() : string{
        $chaine = "recette $this->numRecette ( $this->nomRecette, $this->prixPizza, $this->numPatePizza)";
        return $chaine;
    }

    public static function getIngredient($id){
		$classeRecuperee=static::$classe;
		$identifiant = static::$identifiant;
		$requetePreparee = "SELECT numIngredient,nomIngredient,prixIngredient,quantiteMin,stockI,poidsI FROM $classeRecuperee NATURAL JOIN Compose_recette NATURAL JOIN Ingredient WHERE $identifiant = :id_tag;";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		$tags = array("id_tag"=> $id);
		try {
			$resultat->execute($tags);
			$resultat->setFetchmode(PDO::FETCH_CLASS,"Ingredient");
			$element =$resultat->fetchAll(PDO::FETCH_CLASS,"Ingredient");
            return $element;
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public static function getRecetteActu(){
		$classeRecuperee=static::$classe;
		$identifiant = static::$identifiant;
		$requetePreparee = "SELECT numRecette,nomRecette,cheminImage,prixPizza FROM $classeRecuperee WHERE enActu = 1";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			$resultat->execute();
			$resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecuperee);
			$element =$resultat->fetchAll(PDO::FETCH_CLASS,$classeRecuperee);
            return $element;
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

    public static function ajout_pizza_panier($idRecette){
		$classe=static::$classe;
		$identifiant = static::$identifiant;
		$nom = $classe::getOne($idRecette)->get("nomRecette");
		$pizza =array("nomPizza" => $nom, "numRecette" => $idRecette);
		Pizza::create($pizza);
		$idPizza = connexion::pdo()->lastInsertId();
		Commande_pizza::create(array("numCommande" => $_SESSION["numCommande"], "numPizza" => $idPizza));
	}

}

?>