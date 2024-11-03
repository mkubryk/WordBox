
<?php
require_once("model/ville.php");
require_once("model/adresse.php");
require_once("model/commande.php");
require_once("model/client.php");
require_once("model/etiquette.php");
require_once("model/gerant.php");
require_once("model/ingredient.php");
require_once("model/matiere_premiere.php");
require_once("model/modePaiement.php");
require_once("model/patepizza.php");  
require_once("model/pizza.php");
require_once("model/produit.php");
require_once("model/recette.php");
require_once("model/stat.php");
require_once("controllerCommande.php");

class controllerObjet {

	public static function displayStart(){
		$lesActu = Recette::getRecetteActu();
		include("view/debut.php");
		include("accueil.php");
		include("view/fin.php");
	}

	public static function displayCreationRecipe() {
		include("view/debut.php");
		include("creationRecette.php");
		include("view/fin.php");
	}

    public static function displayAll(){
        $classe=static::$classe;
		$identifiant= static::$identifiant;
        $title = "les $classe (s)";
		include("view/debut.php");
		include("view/menu.php");
		$tableau = $classe::getAll();
		include("view/list.php");
		include("view/fin.php");
	}

	public static function displayOne(){
        $classe=static::$classe;
        $title = "un(e) $classe";
		$identifiant=static::$identifiant;
		if (isset($_GET[$identifiant]))
			$identifiant= $_GET[$identifiant];
		include("view/debut.php");
		include("view/menu.php");
		$element = $classe::getOne($identifiant);
		include("view/details.php");
		include("view/fin.php");
	}

	public static function delete(){
		$classe=static::$classe;
		$identifiant=static::$identifiant;
		if (isset($_GET[$identifiant]))
			$identifiant= $_GET[$identifiant];
		$classe::delete($identifiant);
		if (isset($_SESSION["adminName"]))  {
			$element= self::displayAll();
		}
		else {
			controllerCommande::displayBasket();
		}

	}

	public static function displayCreationForm(){
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
		$title = "création ".$classe;
		include("view/debut.php");
		include("view/menu.php");
		include("view/formulaireCreation.php");
		include("view/fin.php");
	}

	public static function displayCreationFormBis(){
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
		$title = "création ".$classe;
		include("view/formulaireCreation.php");
	}

	public static function displayCreationForm_simple(){
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
		$title = "création ".$classe;
		include("view/formulaireCreation_simple.php");
	}

	public static function create(){
		$champs = static::$champs;
		$donnees = array();
		foreach ($_GET as $key => $value){
			if ($key != "objet" && $key != "action") {
					$donnees[$key] = $value;
			}
		}
		$classe = static::$classe;
		$classe::create($donnees);
		static::displayAll();
	}

	public static function displayUpdateForm(){
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
		if (isset($_GET[$identifiant]))
			$id= $_GET[$identifiant];
		$title = "modification ".$classe;
		$objet = $classe::getOne($id);
		include("view/debut.php");
		include("view/menu.php");
		include("view/formulaireModification.php");
		include("view/fin.php");
	}

	public static function update(){
		$champs = static::$champs;
		$identifiant =static::$identifiant;
		$donnees = array();
		foreach ($_GET as $key => $value){
			if ($key != "objet" && $key != "action") {
				if (in_array($key, array_keys($champs))) {
					$donnees[$key] = $value;
					echo "$value";
				}   
			}
		}
		$donnees[$identifiant]=$_GET[$identifiant];
		$classe = static::$classe;
		$classe::update($donnees);
		static::displayAll();
	}

	public static function lesStocks() {
        $drinks= Produit::getProducts("Boisson");
        $deserts= Produit::getProducts("Dessert");
		$ings = Ingredient::getAll();
		$mps = Matiere_premiere::getAll();
		include("view/debut.php");
        include("stock.php");
		include("view/fin.php");
    }

	public static function lesInfo() {
		if (isset($_GET["identifiant"]))
			$num = $_GET["identifiant"];
		$ings = Recette::getIngredient($num);
		$lesAll = array();

		foreach ($ings as $unIng) {
			array_push($lesAll, Ingredient::getAllergene($unIng->get("numIngredient")));
		}
		$numPate = Recette::getOne($num)->get("numPatePizza");
		$mps = Patepizza::getLesMP($numPate);
		include("view/debut.php");
		include("info_pizza.php");
		include("view/fin.php");
	}

	public static function connect() {
	    $login = $_GET["login"];
        $mdp = $_GET["mdp"];
		$elt=objet::getLogin($login);
		if ($elt == NULL) {
			Client::displayCreationForm();
		}
		elseif ($elt instanceof Gerant ) {
			Gerant::connect($login,$mdp);
		}
		elseif ($elt instanceof Client ) {
			Client::connect($login,$mdp);
		}
	}


}
?>