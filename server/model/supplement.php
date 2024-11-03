<?php 

class Supplement {
    protected int $numPizza;
    protected int $numIngredient;
    protected int $quantiteI;
    
    
  
    public function __construct (int $numPizza= NULL,int $numIngredient= NULL,int $quantiteI= NULL){
        if(!is_null($numPizza) && !is_null($numIngredient)){
           $this->numPizza=$numPizza;
           $this->numIngredient=$numIngredient;
           $this->quantiteI=$quantiteI;
        }
    }

    public static function update($donnees){
		$classeRecuperee = static::$classe;
		$id1= "numPizza";
        $id2 = "numIngredient";
		$champs = "";
		foreach ($donnees as $champ => $valeur) {
			$champs .= "$champ = :$champ, ";
		}
		$champs = rtrim($champs, ', '); 
		$id1_1 = $donnees[$id1];
        $id1_2 = $donnees[$id2];
		$requete = "UPDATE $classeRecuperee SET $champs WHERE $id1 = $id1_1 AND $id2 = $id1_2;"; 
	
		$requetePreparee = connexion::pdo()->prepare($requete);
		try {
			$requetePreparee->execute($donnees);
		} catch (PDOException $e) {
			echo "Erreur lors de la mise à jour : " . $e->getMessage();
            echo "<br>Requête SQL : $requete";
            echo "<br>Données : " . print_r($donnees, true);
		}
	}
    
    
}
?>