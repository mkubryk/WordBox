<?php 
require_once("objet.php");
class Adresse extends objet{
    protected static string $classe ="Adresse";
    protected static string $identifiant = "numAdresse";
    protected int $numAdresse;
    protected string $nomAdr;
    protected int $coordonneeX;
    protected int $coordonneeY;
    protected int $numVille;
   
     //tableau pour construire le <select> :
    // 1. la valeur de l'attribut name
    // 2. le(s) champ(s) à afficher dans le visuel
    protected static $tableauSelect = array("Adresse", "nomAdr");


    public function __construct (int $numAdresse= NULL,string $nomAdr= NULL,int $coordonneeX= NULL,int $coordonneeY= NULL,int $numVille= NULL){
        if(!is_null($numAdresse)){
           $this->numAdresse =$numAdresse;
           $this->nomAdr =$nomAdr;
           $this->coordonneeX=$coordonneeX;
           $this->coordonneeY=$coordonneeY;
           $this->numVille=$numVille;
        }
    }

    //fonction
	public function __toString(){
		$chaine = "adresse $this->numAdresse ($this->nomAdr,$this->coordonneeX,$this->coordonneeY,$this->numVille)";
		return $chaine;
	}


}
?>
