<?php 
require_once("objet.php");
class Matiere_premiere extends objet {

	protected static string $classe = "Matiere_premiere";
	protected static string $identifiant = "numMP";
    protected int $numMP;
    protected string $nomMP;
    protected ?float $poids;
    protected int $numGerant;
    protected ?int $stockMP;
    protected ?int $quantiteMin;
       
    protected static $tableauSelect = array("Matiere_premiere", "nomMP");
  
    public function __construct (int $numMP = NULL,string $nomMP= NULL,float $poids= NULL,int $numGerant= NULL,int $stockMP= NULL,int $quantiteMin= NULL){
        if(!is_null($numMP)){
           $this->numMP=$numMP;
           $this->nomMP=$nomMP;
           $this->poids=$poids;
           $this->numGerant=$numGerant;
           $this->stockMP=$stockMP;
           $this->quantiteMin=$quantiteMin;
        }
    }
    public function __toString() : string{
        $chaine = "Matiere_premiere $this->numMP ( $this->nomMP, $this->poids,$this->numGerant,$this->stockMP,$this->quantiteMin)";
        return $chaine;
    }

    
}
?>