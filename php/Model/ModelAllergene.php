<?php
require_once File::build_path(array("model", "Model.php"));
class ModelAllergene extends Model{

	protected static $object = 'Allergene';
	protected static $primary='idAllergene';

	private $idAllergene;
	private $nomAllergene;

	public function getIdAllergene(){
		return $this->idAllergene;
	}

	public function getNomAllergene(){
		return $this->nomAllergene;
	}

	public function setIdAllergene($idAllergene2){
		$this->idAllergene = $idAllergene2;
	}

	public function setNomAllergene($nomAllergene2){
		$this->nomAllergene = $nomAllergene2;
	}

	public function __construct($nom = NULL, $idAllergene = NULL) {
  	if (!is_null($nom)) {
	    $this->nomAllergene = $nom;
        $this->idAllergene = $idAllergene;
    	}
  	}

  	public function idAllergeneExiste($idA) {
      $sql = "SELECT COUNT(*) FROM Allergene WHERE idAllergene = $idA";
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

    public function configIdAllergene() {
      $sql = "SELECT MAX(idAllergene) FROM Allergene";
      $rep = Model::$pdo->query($sql);  
      $rep->setFetchMode(PDO::FETCH_CLASS, 'Allergene');
     
      $resultat = $rep->fetchAll();
      return $resultat[0][0];
    }

    public function save() {
        try {
            $sql = "INSERT INTO Allergene VALUES (:nomAllergene, :idAllergene)";
            // Préparation de la requête
            $req_prep = Model::$pdo->prepare($sql);

            $values = array(
                "idAllergene" => self::configIdAllergene()+1,
                "nomAllergene" => $this->nomAllergene,
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