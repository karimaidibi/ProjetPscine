<?php
require_once File::build_path(array("model", "Model.php"));
class ModelCoeffCoutPersonnel extends Model{

	protected static $object = 'CoeffCoutPersonnel';
	protected static $primary='CodeCoeffCoutPersonnel';

	private $CodeCoeffCoutPersonnel;
    private $valeurCoeffCoutPersonnel;

	public function getCodeCoeffCoutPersonnel(){
		return $this->CodeCoeffCoutPersonnel;
	}

    public function getvaleurCoeffCoutPersonnel(){
        return $this->valeurCoeffCoutPersonnel;
    }

	public function setCodeCoeffCoutPersonnel($CodeCoeff2){
		$this->CodeCoeffCoutPersonnel = $CodeCoeff2;
	}

	public function setvaleurCoeffCoutPersonnel($valeurCoeffCoutPersonnel2){
		$this->valeurCoeffCoutPersonnel = $valeurCoeffCoutPersonnel2;
	}

	public function __construct($valeurCoeffCoutPersonnel = NULL) {
  	if (!is_null($valeurCoeffCoutPersonnel)) {
        $this->valeurCoeffCoutPersonnel = $valeurCoeffCoutPersonnel;
    	}
  	}

  	public function CodeCoeffExiste($CodeC) {
      $sql = "SELECT COUNT(*) FROM CoeffCoutPersonnel WHERE CodeCoeffCoutPersonnel = $CodeC";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'CoeffCoutPersonnel');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configCodeCoeff() {
      $sql = "SELECT MAX(CodeCoeffCoutPersonnel) FROM CoeffCoutPersonnel";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'CoeffCoutPersonnel');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO CoeffCoutPersonnel VALUES (:CodeCoeffCoutPersonnel, :valeurCoeffCoutPersonnel)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "CodeCoeffCoutPersonnel" => self::configCodeCoeff()+1,
                "valeurCoeffCoutPersonnel" => $this->valeurCoeffCoutPersonnel
            );
            self::setCodeCoeff(self::configCodeCoeff() + 1);
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