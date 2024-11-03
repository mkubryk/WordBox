<?php
require_once("model/gerant.php");
require_once("controller/controllerObjet.php");
class controllerGerant extends controllerObjet {
    
    protected static string $classe = "Gerant";
	protected static string $identifiant = "numGerant";
    protected static $champs = array(
        "nomGerant" => ["text", "Nom"],
        "emailGerant" => ["email", "Email"],
        "adminName" => ["text", "Pseudo"],
        "mdp" => ["password", "Mot de passe"]
    );

    public static function disconnect(){
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time()-1);
        self::displayStart();
    }
}
?>