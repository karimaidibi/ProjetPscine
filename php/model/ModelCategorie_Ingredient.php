<?php
require_once File::build_path(array("model", "Model.php"));
class ModelCategorie_Ingredient extends Model{

	protected static $object = 'Categorie_Ingredient';
	protected static $primary='NumCategorie';

	private $NumCategorie;
	private $NomCategorie;

	public function getNumCategorie(){
		return $this->NumCategorie
;
	}

	public function getNomCategorie(){
		return $this->NomCategorie;
	}

	public function setNumCategorie($NumCategorie2){
		$this->NumCategorie = $NumCategorie2;
	}

	public function setNomCategorie($NomCategorie2){
		$this->NomCategorie = $NomCategorie2;
	}

	public function __construct($nom = NULL) {
  	if (!is_null($nom)) {
	    $this->NomCategorie = $nom;
    	}
  	}

  	public function NumCategorieExiste($NumC) {
      $sql = "SELECT COUNT(*) FROM Categorie_Ingredient WHERE NumCategorie = $NumC";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Categorie_Ingredient');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configNumCategorie() {
      $sql = "SELECT MAX(NumCategorie) FROM Categorie_Ingredient";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Categorie_Ingredient');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Categorie_Ingredient VALUES (:NumCategorie,:NomCategorie)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NumCategorie" => self::configNumCategorie()+1,
                "NomCategorie" => $this->NomCategorie
            );
            // On donne les valeurs et on exécute la requête     
            $req_prep->execute($values);
            // echo $sql;
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
}
?>