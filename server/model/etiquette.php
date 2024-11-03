<?php 
require_once("objet.php");
class Etiquette extends objet{
    
	protected static string $classe = "Etiquette";
	protected static string $identifiant = "codeBarre";
    protected string $codeBarre;
    protected ?string $dateReception;
    protected int $numPizza;
    protected int $numCommande;
    
     //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) à afficher dans le visuel
    protected static $tableauSelect = array("Etiquette", "codeBarre");
  
    public function __construct (string $codeBarre= NULL,string $dateReception= NULL,int $numPizza= NULL,int $numCommande= NULL){
        if(!is_null($codeBarre)){
           $this->codeBarre=$codeBarre;
           $this->dateReception=$dateReception;
           $this->numPizza=$numPizza;
           $this->numCommande=$numCommande;
        }
    }
    public function __toString() : string{
        $chaine = "Etiquette $this->codeBarre ( $this->dateReception, $this->numPizza, $this->numCommande)";
        return $chaine;
    }
}
?>