<?php
require_once File::build_path(array("model", "Model.php"));
class ModelCoefficient extends Model{

	protected static $object = 'Coefficient';
	protected static $primary='CodeCoeff';

	private $CodeCoeff;
    private $valeurCoefficient;

	public function getCodeCoeff(){
		return $this->CodeCoeff;
	}

    public function getvaleurCoefficient(){
        return $this->valeurCoefficient;
    }

	public function setCodeCoeff($CodeCoeff2){
		$this->CodeCoeff = $CodeCoeff2;
	}

	public function setvaleurCoefficient($valeurCoefficient2){
		$this->valeurCoefficient = $valeurCoefficient2;
	}

	public function __construct($CodeCoeff = NULL, $valeurCoefficient = NULL) {
  	if (!is_null($valeurCoefficient)) {
        $this->CodeCoeff = $CodeCoeff;
        $this->valeurCoefficient = $valeurCoefficient;
    	}
  	}

  	public function CodeCoeffExiste($CodeC) {
      $sql = "SELECT COUNT(*) FROM Coefficient WHERE CodeCoeff = $CodeC";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Coefficient');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configCodeCoeff() {
      $sql = "SELECT MAX(CodeCoeff) FROM Coefficient";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Coefficient');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Coefficient VALUES (:CodeCoeff, :valeurCoefficient)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "CodeCoeff" => self::configCodeCoeff()+1,
                "valeurCoefficient" => $this->valeurCoefficient
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