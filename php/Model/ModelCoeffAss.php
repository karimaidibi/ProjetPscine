<?php
require_once File::build_path(array("model", "Model.php"));
class ModelCoeffAss extends Model{

	protected static $object = 'CoeffAss';
	protected static $primary='CodeCoeffAss';

	private $CodeCoeffAss;
    private $valeurCoeffAss;

	public function getCodeCoeffAss(){
		return $this->CodeCoeffAss;
	}

    public function getvaleurCoeffAss(){
        return $this->valeurCoeffAss;
    }

	public function setCodeCoeff($CodeCoeff2){
		$this->CodeCoeffAss = $CodeCoeff2;
	}

	public function setvaleurCoeffAss($valeurCoeffAss2){
		$this->valeurCoeffAss = $valeurCoeffAss2;
	}

	public function __construct($valeurCoeffAss = NULL) {
  	if (!is_null($valeurCoeffAss)) {
        $this->valeurCoeffAss = $valeurCoeffAss;
        $this->CodeCoeffAss = self::configCodeCoeff()+1;
    	}
  	}

  	public function CodeCoeffExiste($CodeC) {
      $sql = "SELECT COUNT(*) FROM CoeffAss WHERE CodeCoeffAss = $CodeC";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'CoeffAss');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configCodeCoeff() {
      $sql = "SELECT MAX(CodeCoeffAss) FROM CoeffAss";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'CoeffAss');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO CoeffAss VALUES (:CodeCoeffAss, :valeurCoeffAss)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "CodeCoeffAss" => self::configCodeCoeff()+1,
                "valeurCoeffAss" => $this->valeurCoeffAss
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