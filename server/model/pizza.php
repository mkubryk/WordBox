<?php 

require_once("objet.php");
class Pizza extends objet {
    
	protected static string $classe = "Pizza";
	protected static string $identifiant = "numPizza";
    protected int $numPizza;
    protected string $nomPizza;
    protected ?string $statutPizza;
    protected int $numRecette;
   
     //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) à afficher dans le visuel
    protected static $tableauSelect = array("Pizza", "nomPizza");
  
    public function __construct (int $numPizza= NULL,string $nomPizza= NULL,string $statutPizza= NULL,int $numRecette= NULL){
        if(!is_null($numPizza)){
           $this->$numPizza=$numPizza;
           $this->nomPizza=$nomPizza;
           $this->statutPizza=$statutPizza;
           $this->numRecette=$numRecette;
        }
    }
    public function __toString() : string{
        $chaine = "Pizza $this->numPizza ( $this->nomPizza, $this->statutPizza,$this->numRecette)";
        return $chaine;
    }
}
?>