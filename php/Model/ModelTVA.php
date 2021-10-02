<?php
require_once File::build_path(array("model", "Model.php"));
class ModelTVA extends Model{

	protected static $object = 'TVA';
	protected static $primary='idTVA';

	private $idTVA;
	private $nomTVA;
    private $coefTVA;

	public function getIdTVA(){
		return $this->idTVA;
	}

	public function getNomTVA(){
		return $this->nomTVA;
	}

    public function getCoefTVA(){
        return $this->coefTVA;
    }

	public function setIdTVA($idTVA2){
		$this->idTVA = $idTVA2;
	}

	public function setNomTVA($nomTVA2){
		$this->nomTVA = $nomTVA2;
	}
    
    public function setCoefTVA($coefTVA2){
        $this->coefTVA = $coefTVA2;
    }

	public function __construct($nom = NULL, $idTVA = NULL, $coef = NULL) {
  	if (!is_null($nom)) {
	    $this->nomTVA = $nom;
        $this->idTVA = $idTVA;
        $this->coefTVA = $coef;
    	}
  	}

  	public function idTVAExiste($idTVA3) {
      $sql = "SELECT COUNT(*) FROM TVA WHERE idTVA = $idTVA3";
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

    public function configIdTVA() {
      $sql = "SELECT MAX(idTVA) FROM TVA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'TVA');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO TVA VALUES (:nomTVA, :idTVA, :coefTVA)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "idTVA" => self::configIdTVA()+1,
                "nomTVA" => $this->nomTVA,
                "coefTVA" => $this->coefTVA,
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