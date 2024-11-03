<?php
require_once("model/supplement.php");
require_once("controller/controllerObjet.php");
class controllerSupplement extends controllerObjet {
    
    protected static string $classe = "Supplement";
	protected static $champs = array(
        "numPizza" => ["number", "Numéro Pizza"],
        "numIngredient" => ["number", "Numéro Ingrédient"],
		"quantiteI" => ["number", "quantite"],
    );

    public static function maj_quantite(){
		$classe=static::$classe;
		$numPizza = $_GET["numPizza"];
        $id1=  "numPizza";
        $id2 = "numIngredient";
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
		$classe::update($donnees);
		static::displayPersonnalise();
    }
	public static function displayPersonnalise(){
		$classe= static::$classe;
		$numPizza = $_GET["numPizza"];
		include("view/debut.php");
		include("personaliser_pizza.php");
		include("view/fin.php");
	}
	
}

?>