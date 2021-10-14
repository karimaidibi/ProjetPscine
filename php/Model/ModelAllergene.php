<?php
require_once File::build_path(array("model", "Model.php"));
class ModelAllergene extends Model{

	protected static $object = 'Allergene';
	protected static $primary='NumAllergene';

	private $NumAllergene;
	private $NomAllergene;

	public function getNumAllergene(){
		return $this->NumAllergene;
	}

	public function getNomAllergene(){
		return $this->NomAllergene;
	}

	public function setNumAllergene($NumAllergene2){
		$this->NumAllergene = $NumAllergene2;
	}

	public function setNomAllergene($NomAllergene2){
		$this->NomAllergene = $NomAllergene2;
	}

	public function __construct($nom = NULL) {
  	if (!is_null($nom)) {
	    $this->NomAllergene = $nom;
    	}
  	}

  	public function NumAllergeneExiste($idA) {
      $sql = "SELECT COUNT(*) FROM Allergene WHERE NumAllergene = $idA";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Allergene');
     
      $resultat = $rep->fetchAll();
      if($resultat[0][0]==1){
      	return true;
      }
      else{
      	return false;
      }
    }

    public function configNumAllergene() {
      $sql = "SELECT MAX(NumAllergene) FROM Allergene";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Allergene');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Allergene VALUES (:NumAllergene, :NomAllergene)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "NumAllergene" => self::configNumAllergene()+1,
                "NomAllergene" => $this->NomAllergene,
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