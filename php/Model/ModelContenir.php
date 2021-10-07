<?php
require_once File::build_path(array("model", "Model.php"));
class ModelContenir extends Model{

	protected static $object = 'Contenir';
	protected static $primary='NumEtape';

	private $NumEtape;
	private $NumeroFiche;

    public function getNumEtape(){
        return $this->NumEtape;
    }

	public function getNumeroFiche(){
		return $this->NumeroFiche;
	}

	public function setNumEtape($NumEtape2){
		$this->NumEtape = $NumEtape2;
	}

	public function setNumeroFiche($NumeroFiche2){
		$this->NumeroFiche = $NumeroFiche2;
	}

	public function __construct($NumEtape = NULL, $NumeroFiche = NULL) {
  	if (!is_null($NumEtape)) {
	    $this->NumEtape = $NumEtape;
        $this->NumeroFiche = $NumeroFiche;
        }
  	}

  	public function NumEtapeExiste($NumA) {
      $sql = "SELECT COUNT(*) FROM Contenir WHERE NumEtape = $NumA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Contenir');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configNumEtape() {
      $sql = "SELECT MAX(NumEtape) FROM Contenir";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Contenir');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Contenir VALUES (:NumEtape, :NumeroFiche)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NumEtape" => self::configNumEtape()+1,
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