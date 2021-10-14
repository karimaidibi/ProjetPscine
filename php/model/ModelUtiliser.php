<?php
require_once File::build_path(array("model", "Model.php"));
class ModelUtiliser extends Model{

	protected static $object = 'Utiliser';
	protected static $primary1 = 'FK_CodeCoeff';
    protected static $primary2 ='FK_NumeroFiche';

	private $FK_CodeCoeff;
	private $FK_NumeroFiche;

    public function getCodeCoeff(){
        return $this->FK_CodeCoeff;
    }

	public function getNumeroFiche(){
		return $this->FK_NumeroFiche;
	}

	public function setCodeCoeff($CodeCoeff2){
		$this->FK_CodeCoeff = $CodeCoeff2;
	}

	public function setNumeroFiche($NumeroFiche2){
		$this->FK_NumeroFiche = $NumeroFiche2;
	}

	public function __construct($FK_CodeCoeff = NULL, $FK_NumeroFiche = NULL) {
  	if (!is_null($FK_CodeCoeff)) {
	    $this->FK_CodeCoeff = $FK_CodeCoeff;
        $this->FK_NumeroFiche = $FK_NumeroFiche;
        }
  	}

  	public function CodeCoeffExiste($NumA) {
      $sql = "SELECT COUNT(*) FROM Utiliser WHERE FK_CodeCoeff = $NumA";
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
      $sql = "SELECT MAX(FK_CodeCoeff) FROM Utiliser";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Utiliser');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Utiliser VALUES (:FK_CodeCoeff, :FK_NumeroFiche)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "FK_CodeCoeff" => $this->FK_CodeCoeff,
                "FK_NumeroFiche" => $this->FK_NumeroFiche
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