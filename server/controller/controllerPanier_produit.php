<?php
require_once("model/panier_produit.php");
require_once("controllerCommande.php");
class controllerPanier_produit  {
    protected static string $classe ="Panier_produit";
	protected static $champs = array(
        "numProduit" => ["text", "Nom du produit"],
        "numCommande" => ["number", "Prix (€)"],
        "quantiteP" => ["number", "Quantité minimale"]
    );
    
    public static function delete(){
		$classe=static::$classe;
        $identifiant= "numProduit";
        $id2 = $_SESSION["numCommande"];
		if (isset($_GET[$identifiant]))
			$id1= $_GET[$identifiant];
		$classe::delete($id1, $id2);
	    controllerCommande::displayBasket();

	}

	public static function update(){
		$classe=static::$classe;
        $identifiant= "numProduit";
        $id2 = $_SESSION["numCommande"];
		$champs = static::$champs;
		$donnees = array();
		foreach ($_GET as $key => $value){
			if ($key != "objet" && $key != "action") {
				if (in_array($key, array_keys($champs))) {
					$donnees[$key] = $value;
					echo "$value";
				}   
			}
		}
		$donnees["numCommande"]=$id2;
		$classe::update($donnees);
		controllerCommande::displayBasket();
	}

}
?>