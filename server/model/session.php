<?php
require_once("client.php");
require_once("gerant.php");

class session {
    public static function clientConnected() {
        return isset($_SESSION["userName"]);
    }

    public static function adminConnected() {
        return isset($_SESSION["adminName"]);
    }

    public static function clientConnecting() {
        return isset($_GET["action"]) && $_GET["action"] == "connect";
    }
}