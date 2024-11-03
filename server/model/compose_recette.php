<?php 
class Compose_recette {
    protected int $numIngredient;
    protected int $numRecette;
  
    public function __construct (int $numIngredient= NULL,int $numRecette= NULL){
        if(!is_null($numIngredient)){
           $this->numIngredient =$numIngredient;
           $this->numRecette =$numRecette;
        }
    }

    public static function create($donnees){
        $champs = implode(", ", array_keys($donnees));
        $tags = ":" . implode(", :", array_keys($donnees));
        $requete = "INSERT INTO Compose_recette ($champs) VALUES ($tags)";
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
	}

}
?>
