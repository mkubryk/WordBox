<?php
require_once("model/commande_pizza.php");
require_once("controllerCommande.php");
class controllerCommande_pizza  {
    protected static string $classe ="Commande_pizza";

    public static function delete(){
		$classe=static::$classe;
        $identifiant= "numPizza";
        $id2 = $_SESSION["numCommande"];
		if (isset($_GET[$identifiant]))
			$id1= $_GET[$identifiant];
		$classe::delete($id1, $id2);
	    controllerCommande::displayBasket();

	}

}
?>