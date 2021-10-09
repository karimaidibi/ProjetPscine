<?php
require_once File::build_path(array("model", "Model.php"));
class ModelEtape extends Model{

	protected static $object = 'Etape';
	protected static $primary='NumEtape';

	private $NumEtape;
    private $DescriptionEtape;

	public function getNumEtape(){
		return $this->NumEtape;
	}

    public function getDescriptionEtape(){
        return $this->DescriptionEtape;
    }

	public function setNumEtape($NumEtape2){
		$this->NumEtape = $NumEtape2;
	}

    public function setDescriptionEtape($DescriptionEtape2){
        $this->DescriptionEtape = $DescriptionEtape2;
    }

	public function __construct($NumEtape = NULL, $DescriptionEtape = NULL) {
  	if (!is_null($NumEtape)) {
        $this->NumEtape = $NumEtape;
        $this->DescriptionEtape = $DescriptionEtape;
    	}
  	}

  	public function NumEtapeExiste($NumA) {
      $sql = "SELECT COUNT(*) FROM Etape WHERE NumEtape = $NumA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Etape');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configNumEtape() {
      $sql = "SELECT MAX(NumEtape) FROM Etape";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Etape');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Etape VALUES (:NumEtape, :DescriptionEtape)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NumEtape" => self::configNumEtape()+1,
                "DescriptionEtape" => $this->DescriptionEtape,
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