<?php
require_once File::build_path(array("model", "Model.php"));
class ModelContenir extends Model{

	protected static $object = 'Utiliser';
	protected static $primary= array('CodeCoeff','NumeroFiche');

	private $CodeCoeff;
	private $NumeroFiche;

    public function getCodeCoeff(){
        return $this->CodeCoeff;
    }

	public function getNumeroFiche(){
		return $this->NumeroFiche;
	}

	public function setCodeCoeff($CodeCoeff2){
		$this->CodeCoeff = $CodeCoeff2;
	}

	public function setNumeroFiche($NumeroFiche2){
		$this->NumeroFiche = $NumeroFiche2;
	}

	public function __construct($CodeCoeff = NULL, $NumeroFiche = NULL) {
  	if (!is_null($CodeCoeff)) {
	    $this->CodeCoeff = $CodeCoeff;
        $this->NumeroFiche = $NumeroFiche;
        }
  	}

  	public function CodeCoeffExiste($NumA) {
      $sql = "SELECT COUNT(*) FROM Utiliser WHERE CodeCoeff = $NumA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Utiliser');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    // ON A PA BESOIN D4INCREMENTER AUTOMATIQUEMENT ICI 
    public function configCodeCoeff() {
      $sql = "SELECT MAX(CodeCoeff) FROM Utiliser";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Utiliser');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Utiliser VALUES (:CodeCoeff, :NumeroFiche)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "CodeCoeff" => $this->CodeCoeff,
                "NumeroFiche" => $this->NumeroFiche
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