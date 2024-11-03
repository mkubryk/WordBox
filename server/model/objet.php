<?php
class objet {

	// getter (pour tout les attributs)
	public function get($attribut){
		return $this->$attribut;
	}
	
	// setter (pour tout les attributs)
	public function set($attribut, $valeur){
		$this->$attribut = $valeur;
	}
	
	public static function getAll(){
		$classeRecuperee = static::$classe;
		$requete = "SELECT * FROM $classeRecuperee;";
		//envoi de la requete et stockage de la reponse dans une variable $resultat
		$resultat = connexion::pdo()->query($requete);
		//traitement de la reponse par le prisme de la classe
		$resultat->setFetchmode(PDO::FETCH_CLASS, $classeRecuperee);
		//recuperation des instances de bd dans une variable $tableau
		$tableau = $resultat->fetchALL();
		//on retourne Le tableau d'instances
		return $tableau;
	}

	public static function getOne($id){
		$classeRecuperee=static::$classe;
		$identifiant = static::$identifiant;
		$requetePreparee = "SELECT * FROM $classeRecuperee WHERE $identifiant = :id_tag;";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		$tags = array("id_tag"=> $id);
		try {
			$resultat->execute($tags);
			$resultat->setFetchmode(PDO::FETCH_CLASS,$classeRecuperee);
			$element =$resultat->fetch();
			return $element;
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public static function getLogin($login){
		$requetePreparee = "SELECT * FROM Gerant WHERE adminName = :login;";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		try {
			$resultat->execute(array(':login' => $login));
			$resultat->setFetchmode(PDO::FETCH_CLASS, "Gerant");
			$element = $resultat->fetch();
			if ($element == NULL) {
				$requetePreparee = "SELECT * FROM Client WHERE userName = :login;";
				$resultat = connexion::pdo()->prepare($requetePreparee);
				try {
					$resultat->execute(array(':login' => $login));
					$resultat->setFetchmode(PDO::FETCH_CLASS, "Client");
					$element = $resultat->fetch();
				} catch (PDOException $e) {
					echo $e->getMessage();
				}
			}	
		return $element;
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}

	public static function delete ($id) {
		$classeRecuperee=static::$classe;
		$identifiant = static::$identifiant;
		$requetePreparee = "DELETE FROM $classeRecuperee WHERE $identifiant = :id_tag;";
		$resultat = connexion::pdo()->prepare($requetePreparee);
		$tags = array("id_tag" => $id);
		try {
			$resultat->execute($tags);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public static function create($donnees){
        $classeRecuperee = static::$classe;
        $champs = implode(", ", array_keys($donnees));
        $tags = ":" . implode(", :", array_keys($donnees));
        $requete = "INSERT INTO $classeRecuperee ($champs) VALUES ($tags)";
        echo "$requete";
		$pdo = connexion::pdo();
        try {
            $requetePreparee = $pdo->prepare($requete);
            $requetePreparee->execute($donnees);
            echo "Insertion réussie !";
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            echo "<br>Requête SQL : $requete";
            echo "<br>Données : " . print_r($donnees, true);
        }
	}

	public static function update($donnees){
		$classeRecuperee = static::$classe;
		$identifiant = static::$identifiant;
		$champs = "";
		foreach ($donnees as $champ => $valeur) {
			$champs .= "$champ = :$champ, ";
		}
		$champs = rtrim($champs, ', '); 
		$id = $donnees[$identifiant];
		$requete = "UPDATE $classeRecuperee SET $champs WHERE $identifiant = $id"; 
	
		$requetePreparee = connexion::pdo()->prepare($requete);
		try {
			$requetePreparee->execute($donnees);
			echo "update réussi !";
		} catch (PDOException $e) {
			echo "Erreur lors de la mise à jour : " . $e->getMessage();
            echo "<br>Requête SQL : $requete";
            echo "<br>Données : " . print_r($donnees, true);
		}
	}
	
	

	public static function getSelect() {
		$tableauSelect = static::$tableauSelect;
		$classeRecuperee = $tableauSelect[0];
		$identifiant =$classeRecuperee::$identifiant;
		$nom = $tableauSelect[1];
		$requete = "SELECT `$identifiant`,`$nom` FROM `$classeRecuperee`";
		$resultats = connexion::pdo()->query($requete);
		$resultats = $resultats->fetchAll(PDO::FETCH_ASSOC);
		$baliseSelect = '<select name="' . $identifiant . '">';
	
		foreach ($resultats as $resultat) {
			$baliseSelect .= '<option value="' . $resultat[$identifiant] . '">';
			$baliseSelect .=  ' - ' . $resultat[$nom]. '</option>';
		}
	
		$baliseSelect .= '</select>';
	
		return $baliseSelect;
	}
	
	
	

	public function affichable() {return true;}
}
?>