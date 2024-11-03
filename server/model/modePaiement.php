<?php 
require_once("objet.php");
class Modepaiement extends objet{
    protected static string $classe = "Modepaiement";
	protected static string $identifiant = "numModeP";
    protected int $numModeP;
    protected string $nomModep;
    
    //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) à afficher dans le visuel
    protected static $tableauSelect = array("Modepaiement", "nomModep");
  
    public function __construct (int $numModeP = NULL,string $nomModep = NULL){
        if(!is_null($numModeP)){
           $this->numModeP=$numModeP;
           $this->nomModep=$nomModep;
        }
    }
    public function __toString() : string{
        $chaine = "Modepaiement $this->numModeP ( $this->nomModep)";
        return $chaine;
    }
}
?>