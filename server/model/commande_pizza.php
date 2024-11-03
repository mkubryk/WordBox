<?php 
class Commande_pizza {
    protected int $numCommande;
    protected int $numPizza;
    protected static string $classe = "Commande_pizza";

    public function __construct (int $numCommande= NULL,int $numPizza= NULL){
        if(!is_null($numCommande)){
           $this->numCommande =$numCommande;
           $this->numPizza =$numPizza;
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

    public static function delete ($idPizza,$idCmde) {
		$classeRecuperee=static::$classe;
		$id1= "numPizza";
        $id2 = "numCommande";
		$requetePreparee = "DELETE FROM $classeRecuperee WHERE $id1 = :id1 AND $id2 = :id2;";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		$tags = array("id1" => $idPizza, "id2" => $idCmde);
		try {
			$resultat->execute($tags);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>
