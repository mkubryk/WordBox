<?php 
require_once("objet.php");

class Ville extends objet{

    protected static string $classe = "Ville";
	protected static string $identifiant = "numVille";
    protected int $numVille;
    protected string $nomVille;
    protected int $codePostal;
     //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) à afficher dans le visuel
    protected static $tableauSelect = array("Ville", "nomVille");

  
    public function __construct (int $numVille= NULL,string $nomVille= NULL,int $codePostal= NULL){
        if(!is_null($numVille)){
           $this->numVille=$numVille;
           $this->nomVille=$nomVille;
           $this->codePostal=$codePostal;
        }
    }
    public function __toString() : string{
        $chaine = "ville $this->numVille ( $this->nomVille, $this->codePostal)";
        return $chaine;
    }
   
}
?>