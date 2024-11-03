<?php 
require_once("panier_produit.php");
require_once("objet.php");

class Produit extends objet{
    
	protected static string $classe = "Produit";
	protected static string $identifiant = "numProduit";
    protected int $numProduit;
    protected string $nomProduit;
    protected ?float $prixProduit;
    protected ?int $quantiteMin;
    protected ?string $typeProduit;
    protected int $numGerant;
    protected ?int $stockP;
    protected ?string $cheminImage;
    
  
    public function __construct (int $numProduit = NULL, string $nomProduit = NULL, float $prixProduit = NULL, int $quantiteMin = NULL, string $typeProduit = NULL, int $numGerant = NULL, int $stockP = NULL, string $cheminImage = NULL) {
        if (!is_null($numProduit)) {
            $this->numProduit = $numProduit;
            $this->nomProduit = $nomProduit;
            $this->prixProduit = number_format($prixProduit, 2);
            $this->quantiteMin = $quantiteMin;
            $this->typeProduit = $typeProduit;
            $this->numGerant = $numGerant;
            $this->stockP = $stockP;
            $this->cheminImage = $cheminImage;
        }
    }
    
    public function __toString() : string{
        $chaine = "Produit $this->numProduit ( $this->nomProduit, $this->prixProduit, $this->quantiteMin,$this->typeProduit)";
        return $chaine;
    }

        //renvoie un tableau avec tous les produits ayant pour type $type
    public static function getProducts($type) {
        $classeRecuperee = static::$classe;
        $requete = "SELECT * FROM $classeRecuperee WHERE typeProduit= :type";
        $connexion = connexion::pdo();
        if ($connexion == null) {
            echo "Erreur de connexion à la base de données.";
            return array(); 
        }
        try {
            // Préparez la requête avec un paramètre
            $stmt = $connexion->prepare($requete);
            $stmt->bindParam(':type', $type, PDO::PARAM_STR);
            // Exécutez la requête
            $stmt->execute();
            // Traitement de la réponse par le prisme de la classe
            $stmt->setFetchMode(PDO::FETCH_CLASS, $classeRecuperee);
            // Récupération des instances de la base de données dans une variable $tableau
            $tableau = $stmt->fetchAll();
            // On retourne le tableau d'instances
            return $tableau;
        } catch (PDOException $e) {
            // Gestion de l'erreur PDO
            echo "Erreur PDO : " . $e->getMessage();
            return array(); 
        }
    }

    public static function ajout_produit_panier($idProduit){
		$classe=static::$classe;
		$identifiant = static::$identifiant;
		$num = $classe::getOne($idProduit)->get("numProduit");
		Panier_produit::create(array("numCommande" => $_SESSION["numCommande"], "numProduit" => $num, "quantiteP" => 1));
	}


}
?>