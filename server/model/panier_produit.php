<?php 
class Panier_produit {
    protected int $numCommande;
    protected int $numProduit;
    protected ?int $quantiteP;
    protected static string $classe = "Panier_produit";
  
    public function __construct (int $numCommande= NULL,int $numProduit= NULL,int $quantiteP= NULL){
        if(!is_null($numCommande) && !is_null($numProduit)){
           $this->numCommande=$numCommande;
           $this->numProduit=$numProduit;
           $this->quantiteP=$quantiteP;
        }
    }

    public static function create($donnees){
        $classeRecuperee = static::$classe;
        $champs = implode(", ", array_keys($donnees));
        $tags = ":" . implode(", :", array_keys($donnees));
        $requete = "INSERT INTO $classeRecuperee ($champs) VALUES ($tags)";
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

    public static function delete ($idProduit,$idCmde) {
		$classeRecuperee=static::$classe;
		$id1= "numProduit";
        $id2 = "numCommande";
		$requetePreparee = "DELETE FROM $classeRecuperee WHERE $id1 = :id1 AND $id2 = :id2;";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		$tags = array("id1" => $idProduit, "id2" => $idCmde);
		try {
			$resultat->execute($tags);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

    public static function update($donnees){
		$classeRecuperee = static::$classe;
		$id1= "numProduit";
        $id2 = "numCommande";
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