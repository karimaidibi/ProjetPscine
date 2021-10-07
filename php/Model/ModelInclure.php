<?php
require_once File::build_path(array("model", "Model.php"));
class ModelInclure extends Model{

	protected static $object = 'Inclure';
	protected static $primary='NumeroFiche';

	private $NumeroFiche;
	private $NumeroSousFiche;

    public function getNumeroFiche(){
        return $this->NumeroFiche;
    }

	public function getNumeroSousFiche(){
		return $this->NumeroSousFiche;
	}

	public function setNumeroFiche($NumeroFiche2){
		$this->NumeroFiche = $NumeroFiche2;
	}

	public function setNumeroSousFiche($NumeroSousFiche2){
		$this->NumeroSousFiche = $NumeroSousFiche2;
	}

	public function __construct($NumeroFiche = NULL, $NumeroSousFiche = NULL) {
  	if (!is_null($NumeroFiche)) {
	    $this->NumeroFiche = $NumeroFiche;
        $this->NumeroSousFiche = $NumeroSousFiche;
        }
  	}

  	public function NumeroFicheExiste($NumA) {
      $sql = "SELECT COUNT(*) FROM Inclure WHERE NumeroFiche = $NumA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Inclure');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configNumeroFiche() {
      $sql = "SELECT MAX(NumeroFiche) FROM Inclure";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Inclure');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Inclure VALUES (:NumeroFiche, :NumeroSousFiche)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NumeroFiche" => self::configNumeroFiche()+1,
                "NumeroSousFiche" => $this->NumeroSousFiche
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