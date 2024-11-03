<?php
require_once("model/produit.php");
require_once("model/pizza.php");
require_once("objet.php");

class Commande extends objet{
    protected static string $classe ="Commande";
    protected static string $identifiant = "numCommande";
    protected int $numCommande;
    protected ?string $dateCommande;
    protected ?string $statutCommande;
    protected ?int $numLivraison;
    protected int $numModeP;
    protected int $numClient;

     //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) à afficher dans le visuel
    protected static $tableauSelect = array("Commande", "numCommande");


    public function __construct (int $numCommande= NULL,string $dateCommande= NULL,string $statutCommande= NULL,int $numLivraison= NULL, int $numModeP= NULL, int $numClient= NULL){
        if(!is_null($numCommande)){
            $this->numCommande=$numCommande;
            $this-> dateCommande=$dateCommande;
            $this->statutCommande=$statutCommande;
            $this->numLivraison=$numLivraison;
            $this->numModeP=$numModeP;
            $this->numClient=$numClient;
        }
    }
    public function __toString() : string{
        $chaine = "Commande $this->numCommande ( $this->dateCommande, $this->statutCommande, $this->numLivraison,$this->numModeP,$this->numClient)";
        return $chaine;
    }

    public function remplirPanier() {
        $panier = array();
    
        // Ajoute au panier les pizzas de la commande
        $requetePrepareePizza = "SELECT numPizza, nomPizza, statutPizza, numRecette FROM Commande NATURAL JOIN Commande_pizza NATURAL JOIN Pizza WHERE numCommande = :numCmde;";
        $resultatPizza = connexion::pdo()->prepare($requetePrepareePizza);
    
        try {
            $resultatPizza->execute(array(':numCmde' => $this->numCommande));
            $resultatPizza->setFetchMode(PDO::FETCH_CLASS, "Pizza");
            $lesPizzas = $resultatPizza->fetchAll(PDO::FETCH_CLASS, "Pizza");
    
            // Ajout des pizzas au panier
            foreach ($lesPizzas as $pizza) {
                array_push($panier, $pizza);
            }
    
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    
        // Ajoute au panier les produits de la commande
        $requetePrepareeProduit = "SELECT numProduit, nomProduit, prixProduit, typeProduit, stockP, quantiteMin, cheminImage FROM Commande natural join Panier_produit NATURAL JOIN Produit WHERE numCommande = :numCmde;";
        $resultatProduit = connexion::pdo()->prepare($requetePrepareeProduit);
    
        try {
            $resultatProduit->execute(array(':numCmde' => $this->numCommande));
            $resultatProduit->setFetchMode(PDO::FETCH_CLASS, "Produit");
            $lesProduits = $resultatProduit->fetchAll(PDO::FETCH_CLASS, "Produit");
    
            // Ajout des produits au panier
            foreach ($lesProduits as $produit) {
                array_push($panier, $produit);
            }
    
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    
        return $panier;
    }
    
    // Renvoie le total de la commande 
    public function prixCommande() {
        $requete = "SELECT prixCommande($this->numCommande);";
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $prixC = $resultat->fetch();
        return $prixC[0];
    }
    
    
}
?>