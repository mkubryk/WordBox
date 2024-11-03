<?php

class Statistique {

    /** ----------------------LES BENEFICES-------------------- */

    // Renvoie le total de bénéfice de l'année qui précède
    public static function getTTBenef() {
        $requete = "SELECT TTBenefAn(YEAR(NOW())-1)";
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $TTbenef = $resultat->fetch();
        return $TTbenef;
    }

    // Renvoie le total de bénéfice du mois actuel
    public static function getBenefM() {
        //$requete = "SELECT TTBenefMois(MONTH(NOW()),YEAR(NOW()))";
        $requete = "SELECT TTBenefMois(10,YEAR(NOW())-1)";
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $TTbenef = $resultat->fetch();
        return $TTbenef;
    }

    // Renvoie le total de bénéfice du jour actuel
    public static function getBenefJ() {
        $requete = "SELECT TTBenefJour(MONTH(NOW()),DAY(NOW()),YEAR(NOW()))";
        //$requete = "SELECT TTBenefJour(25,10,YEAR(NOW())-1)";
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $TTbenef = $resultat->fetch();
        return $TTbenef;
    }

    /** --------------------LES DEPENSES ---------------------------*/

    // Renvoie le total de dépense du mois actuel
    public static function getDepenseM() {
        //$requete = "SELECT TTDepMois(MONTH(NOW()),YEAR(NOW()))";
        $requete = "SELECT TTDepMois(10,YEAR(NOW())-1)";
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $TTDep = $resultat->fetch();
        return $TTDep;
    }

    // Renvoie le total de dépense de l'année précédente
    public static function getTTDepense() {
        $requete = "SELECT TTDepAn(YEAR(NOW())-1)";
        
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $TTDep = $resultat->fetch();
        return $TTDep;
    }

    // Renvoie le total de dépense du jour
    public static function getDepenseJ() {
        $requete ="SELECT TTDepJour(DAY(NOW()),MONTH(NOW()),YEAR(NOW()))";
        //$requete ="SELECT TTDepJour(25,10,2023)";
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $TTDep = $resultat->fetch();
        return $TTDep;
    }


    /** ------------------LES CHIFFRES D AFFAIRES-------------------- */

    // Renvoie le chiffre d'affaire annuel 
    public static function getCAA() {
        $requete ="SELECT chiffreAffAn(YEAR(NOW())-1)";
        //$requete ="SELECT chiffreAffAn(2023)";
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $CA = $resultat->fetch();
        return $CA;
    }

    // Renvoie le chiffre d'affaire mensuel 
    public static function getCAM() {
        //$requete ="SELECT chiffreAffMois(MONTH(NOW()),YEAR(NOW()))";
        $requete ="SELECT chiffreAffMois(10,YEAR(NOW())-1)";
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $CA = $resultat->fetch();
        return $CA;
    }

    // Renvoie le chiffre d'affaire de la semaine 
    public static function getCAS() {
       //$requete ="SELECT chiffreAffSemaine(WEEK(NOW()),MONTH(NOW()),YEAR(NOW()))";
       $requete ="SELECT chiffreAffSemaine(1,10,YEAR(NOW())-1)"; //semaine mois annee
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $CA = $resultat->fetch();
        return $CA;
    }

    // Renvoie le chiffre d'affaire du jour 
    public static function getCAJ() {
        $requete ="SELECT chiffreAffJour(MONTH(NOW()),DAY(NOW()),YEAR(NOW()))";
        //$requete ="SELECT chiffreAffJour(10,25,YEAR(NOW())-1)";
        // Envoi de la requête et stockage de la réponse dans une variable $resultat
        $resultat = connexion::pdo()->query($requete);
        // Récupération des instances de BD dans une variable $tableau
        $CA = $resultat->fetch();
        return $CA;
    }

}
?>
