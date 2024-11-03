<?php 

require_once("objet.php");
class Ingredient extends objet {

	protected static string $classe = "Ingredient";
	protected static string $identifiant = "numIngredient";
    protected int $numIngredient;
    protected string $nomIngredient;
    protected ?float $prixIngredient;
    protected ?int $quantiteMin;
    protected int $numGerant;
    protected ?int $stockI;
    protected ?float $poidsI;
    protected static $champs = array(
        "nomIngredient" => ["text", "Nom de l'ingrédient"],
        "prixIngredient" => ["number", "Prix (€)"],
        "quantiteMin" => ["number", "Quantité minimale"],
        "stockI" => ["number", "Nombre en stock"],
        "poidsI" => ["number", "Poids à l'unité (gramme)"]
    );
    protected static $tableauSelect = array("Ingredient", "nomIngredient");

  
    public function __construct (int $numIngredient = NULL,string $nomIngredient = NULL,float $prixIngredient= NULL,int $quantiteMin= NULL,int $numGerant= NULL,int $stockI= NULL,float $poidsI= NULL){
        if(!is_null($numIngredient)){
            $this->numIngredient=$numIngredient;
            $this->nomIngredient=$nomIngredient;
            $this->prixIngredient=$prixIngredient;
            $this->quantiteMin=$quantiteMin;
            $this->numGerant=$numGerant;
            $this->stockI=$stockI;
            $this->poidsI=$poidsI;
        }
    }
    public function __toString() : string{
        $chaine = "Ingrédient $this->numIngredient ( $this->nomIngredient, $this->prixIngredient,$this->quantiteMin,$this->numGerant,$this->stockI,$this->poidsI)";
        return $chaine;
    }

    public static function getAllergene($id){
		$classeRecuperee=static::$classe;
		$identifiant = static::$identifiant;
		$requetePreparee = "SELECT numAll,nomAll FROM $classeRecuperee NATURAL JOIN Est_allergenique NATURAL JOIN Allergene WHERE $identifiant = :id_tag;";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		$tags = array("id_tag"=> $id);
		try {
			$resultat->execute($tags);
			$resultat->setFetchmode(PDO::FETCH_CLASS,"Allergene");
			$element =$resultat->fetch();
			return $element;
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

}
?>