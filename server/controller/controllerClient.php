<?php
require_once("model/client.php");
require_once("controller/controllerObjet.php");
class controllerClient extends controllerObjet {
    
    protected static string $classe = "Client";
	protected static string $identifiant = "login";
    protected static $champs = array(
        "nomClient" => ["text", "Nom"],
        "prenomClient" => ["text", "Prénom"],
        "login" => ["text", "Pseudo"],
        "mdp" => ["password", "Mot de passe"]
    );
    
/*    public static function displayCreationForm() {
        $title= "création client";
		$champs = static::$champs;
		$classe= static::$classe;
		$identifiant =static::$identifiant;
        $selectAdresse = Adresse::getSelect();
        include("view/debut.php");
        include("view/menu.php");        
        include("view/formulaireCreation_bis.php");
        include("view/client/formulaireCreation.php");
        include("view/fin.php");
    }

    public static function displayConnectionForm(){
        $title= "connexion client";
        include("connexion.php");
    }  
*/
    public static function disconnect(){
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time()-1);
        self::displayStart();
    }
    
}
?>