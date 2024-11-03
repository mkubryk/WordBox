<?php
require_once("objet.php");
class Mot_sympa extends objet{
    protected static string $classe ="Mot_sympa";
    protected static string $identifiant = "numMot";
    protected int $numMot;
    protected string $nomMot;
    protected string $prononciation;
    protected string $definitionMot;
    

    public function __construct (int $numMot= NULL, string $nomMot= NULL, string $prononciation=NULL, string $definitionMot=NULL){
        if(!is_null($numMot)){
           $this->numMot =$numMot;
           $this->nomMot =$nomMot;
           $this->prononciation=$prononciation;
           $this->definitionMot=$definitionMot;
        }
    }

    //fonction
	public function __toString(){
		$chaine = "mot $this->numMot ($this->nomMot)";
		return $chaine;
	}
}
?>