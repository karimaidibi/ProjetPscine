<?php
require_once File::build_path(array("model", "Model.php"));
class ModelTVA extends Model{

	protected static $object = 'TVA';
	protected static $primary='CodeTVA';

	private $CodeTVA;
	private $NomTVA;
    private $CoefTVA;

	public function getCodeTVA(){
		return $this->CodeTVA;
	}

	public function getNomTVA(){
		return $this->NomTVA;
	}

    public function getCoefTVA(){
        return $this->CoefTVA;
    }

	public function setCodeTVA($CodeTVA2){
		$this->CodeTVA = $CodeTVA2;
	}

	public function setNomTVA($NomTVA2){
		$this->NomTVA = $NomTVA2;
	}
    
    public function setCoefTVA($CoefTVA2){
        $this->CoefTVA = $CoefTVA2;
    }

	public function __construct($nom = NULL, $CodeTVA = NULL, $coef = NULL) {
  	if (!is_null($nom)) {
	    $this->NomTVA = $nom;
        $this->CodeTVA = $CodeTVA;
        $this->CoefTVA = $coef;
    	}
  	}

  	public function CodeTVAExiste($CodeTVA3) {
      $sql = "SELECT COUNT(*) FROM TVA WHERE CodeTVA = $CodeTVA3";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'TVA');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configCodeTVA() {
      $sql = "SELECT MAX(CodeTVA) FROM TVA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'TVA');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO TVA VALUES (:NomTVA, :CodeTVA, :CoefTVA)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "CodeTVA" => self::configCodeTVA()+1,
                "NomTVA" => $this->NomTVA,
                "CoefTVA" => $this->CoefTVA,
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