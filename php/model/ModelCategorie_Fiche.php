<?php
require_once File::build_path(array("model", "Model.php"));
class ModelCategorie extends Model{

	protected static $object = 'Categorie_Fiche';
	protected static $primary='NumeroCatFiche';

	private $NumeroCatFiche;
	private $NomCatFiche;

	public function getNumeroCatFiche(){
		return $this->NumeroCatFiche
;
	}

	public function getNomCatFiche(){
		return $this->NomCatFiche;
	}

	public function setNumeroCatFiche($NumeroCatFiche2){
		$this->NumeroCatFiche = $NumeroCatFiche2;
	}

	public function setNomCatFiche($NomCatFiche2){
		$this->NomCatFiche = $NomCatFiche2;
	}

	public function __construct($nom = NULL, $NumeroCatFiche = NULL) {
  	if (!is_null($nom)) {
	    $this->NomCatFiche = $nom;
        $this->NumeroCatFiche = $NumeroCatFiche;
    	}
  	}

  	public function NumeroCatFicheExiste($NumC) {
      $sql = "SELECT COUNT(*) FROM Categorie_Fiche WHERE NumeroCatFiche = $NumC";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Categorie_Fiche');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configNumeroCatFiche() {
      $sql = "SELECT MAX(NumeroCatFiche) FROM Categorie_Fiche";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Categorie_Fiche');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Categorie_Fiche VALUES (:NumeroCatFiche,:NomCatFiche)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NumeroCatFiche" => self::configNumeroCatFiche()+1,
                "NomCatFiche" => $this->NomCatFiche
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